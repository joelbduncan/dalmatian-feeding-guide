<?php

declare(strict_types=1);

require_once __DIR__ . '/SmtpMailer.php';

/**
 * Handles the contact form: CSRF token, spam checks, validation,
 * rate limiting and sending through SMTP.
 */
final class ContactForm
{
    private const MIN_SECONDS_TO_FILL = 3;   // bots submit instantly
    private const SECONDS_BETWEEN_SENDS = 60;

    public array $errors = [];
    public array $old = ['name' => '', 'email' => '', 'message' => ''];
    public bool $sent = false;

    public function __construct(private array $site)
    {
        self::startSession();
    }

    public static function isConfigured(array $site): bool
    {
        return ($site['smtp']['host'] ?? '') !== ''
            && filter_var($site['contact']['to'] ?? '', FILTER_VALIDATE_EMAIL)
            && filter_var($site['smtp']['from_email'] ?? '', FILTER_VALIDATE_EMAIL);
    }

    public function token(): string
    {
        $_SESSION['contact_token'] ??= bin2hex(random_bytes(32));
        $_SESSION['contact_rendered_at'] = time();
        return $_SESSION['contact_token'];
    }

    /** Show the success message once after the redirect. */
    public function pullFlash(): void
    {
        if (!empty($_SESSION['contact_sent'])) {
            $this->sent = true;
            unset($_SESSION['contact_sent']);
        }
    }

    /** @return bool true when the message was sent (caller should redirect) */
    public function handle(array $post): bool
    {
        $this->old = [
            'name'    => trim((string) ($post['name'] ?? '')),
            'email'   => trim((string) ($post['email'] ?? '')),
            'message' => trim((string) ($post['message'] ?? '')),
        ];

        $tokenOk = is_string($post['_token'] ?? null)
            && isset($_SESSION['contact_token'])
            && hash_equals($_SESSION['contact_token'], $post['_token']);
        if (!$tokenOk) {
            $this->errors['form'] = 'Your session expired. Please try sending again.';
            return false;
        }

        // Spam traps: a hidden field real people never fill in, and a minimum fill time.
        $tooFast = time() - (int) ($_SESSION['contact_rendered_at'] ?? 0) < self::MIN_SECONDS_TO_FILL;
        if (($post['hp_field'] ?? '') !== '' || $tooFast) {
            // Pretend it worked so bots don't learn anything.
            return $this->succeed();
        }

        $lastSent = (int) ($_SESSION['contact_last_sent'] ?? 0);
        if (time() - $lastSent < self::SECONDS_BETWEEN_SENDS) {
            $this->errors['form'] = 'Please wait a minute before sending another message.';
            return false;
        }

        $this->validate();
        if ($this->errors) {
            return false;
        }

        $smtp = $this->site['smtp'];
        $prefix = $this->site['contact']['subject_prefix'] ?? '';
        $body = "Name: {$this->old['name']}\n"
            . "Email: {$this->old['email']}\n"
            . 'Sent: ' . date('j F Y, H:i') . "\n\n"
            . $this->old['message'] . "\n";

        try {
            (new SmtpMailer($smtp))->send(
                from: [$smtp['from_email'], $smtp['from_name'] ?? $this->site['name']],
                to: [$this->site['contact']['to']],
                subject: trim("{$prefix} Message from {$this->old['name']}"),
                body: $body,
                replyTo: [$this->old['email'], $this->old['name']],
            );
        } catch (Throwable $e) {
            error_log('Contact form: ' . $e->getMessage());
            $this->errors['form'] = "Sorry, your message couldn't be sent just now. Please try again later.";
            return false;
        }

        $_SESSION['contact_last_sent'] = time();
        return $this->succeed();
    }

    private function validate(): void
    {
        $len = fn (string $s) => mb_strlen($s, 'UTF-8');

        if ($this->old['name'] === '') {
            $this->errors['name'] = 'Please enter your name.';
        } elseif ($len($this->old['name']) > 100) {
            $this->errors['name'] = 'That name is too long.';
        }

        if (!filter_var($this->old['email'], FILTER_VALIDATE_EMAIL)) {
            $this->errors['email'] = 'Please enter a valid email address.';
        }

        if ($len($this->old['message']) < 10) {
            $this->errors['message'] = 'Please write a little more (at least 10 characters).';
        } elseif ($len($this->old['message']) > 5000) {
            $this->errors['message'] = 'Please keep your message under 5,000 characters.';
        }
    }

    private function succeed(): bool
    {
        $_SESSION['contact_sent'] = true;
        unset($_SESSION['contact_token']); // one token per message
        return true;
    }

    private static function startSession(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            return;
        }
        $https = ($_SERVER['HTTPS'] ?? '') !== '' && $_SERVER['HTTPS'] !== 'off';
        session_name('dfg_session');
        session_start([
            'cookie_httponly' => true,
            'cookie_secure'   => $https,
            'cookie_samesite' => 'Lax',
            'use_strict_mode' => true,
        ]);
    }
}
