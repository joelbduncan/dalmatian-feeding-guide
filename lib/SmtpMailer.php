<?php

declare(strict_types=1);

/**
 * Minimal SMTP client: no Composer, no PHP mail() function.
 *
 * Supports STARTTLS (port 587), implicit TLS (port 465) and unencrypted
 * connections, with AUTH PLAIN or AUTH LOGIN. It sends plain-text UTF-8
 * messages, which is all the contact form needs.
 */
final class SmtpMailer
{
    /** @var resource|null */
    private $socket = null;
    private array $capabilities = [];

    /**
     * @param array{host: string, port?: int, encryption?: string, username?: string,
     *              password?: string, timeout?: int, helo?: string, verify_peer?: bool} $config
     *        encryption: "tls" (STARTTLS), "ssl" (implicit TLS) or "none"
     */
    public function __construct(private array $config)
    {
    }

    /**
     * @param array{0: string, 1?: string} $from    [email, name]
     * @param array{0: string, 1?: string} $to      [email, name]
     * @param array{0: string, 1?: string}|null $replyTo
     * @throws RuntimeException when the server rejects the message or can't be reached
     */
    public function send(array $from, array $to, string $subject, string $body, ?array $replyTo = null): void
    {
        foreach (array_filter([$from[0], $to[0], $replyTo[0] ?? null]) as $address) {
            if (!filter_var($address, FILTER_VALIDATE_EMAIL)) {
                throw new InvalidArgumentException("Invalid email address: {$address}");
            }
        }

        try {
            $this->connect();
            $this->authenticate();

            $this->command('MAIL FROM:<' . $from[0] . '>', [250]);
            $this->command('RCPT TO:<' . $to[0] . '>', [250, 251]);
            $this->command('DATA', [354]);
            $this->write($this->buildMessage($from, $to, $subject, $body, $replyTo) . "\r\n.");
            $this->expect([250]);
            try {
                $this->command('QUIT', [221]);
            } catch (RuntimeException) {
                // The message was already accepted; a messy goodbye doesn't matter.
            }
        } finally {
            $this->disconnect();
        }
    }

    private function connect(): void
    {
        $host = $this->config['host'];
        $port = (int) ($this->config['port'] ?? 587);
        $encryption = strtolower($this->config['encryption'] ?? 'tls');
        $timeout = (int) ($this->config['timeout'] ?? 15);

        $context = stream_context_create(['ssl' => [
            'verify_peer'      => $this->config['verify_peer'] ?? true,
            'verify_peer_name' => $this->config['verify_peer'] ?? true,
            'peer_name'        => $host,
        ]]);

        $remote = ($encryption === 'ssl' ? 'ssl://' : 'tcp://') . "{$host}:{$port}";
        $socket = @stream_socket_client($remote, $errno, $errstr, $timeout, STREAM_CLIENT_CONNECT, $context);
        if (!$socket) {
            throw new RuntimeException("Could not connect to SMTP server {$host}:{$port}: {$errstr} ({$errno})");
        }
        $this->socket = $socket;
        stream_set_timeout($this->socket, $timeout);

        $this->expect([220]);
        $this->ehlo();

        if ($encryption === 'tls') {
            $this->command('STARTTLS', [220]);
            $crypto = STREAM_CRYPTO_METHOD_TLSv1_2_CLIENT | (defined('STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT') ? STREAM_CRYPTO_METHOD_TLSv1_3_CLIENT : 0);
            if (!@stream_socket_enable_crypto($this->socket, true, $crypto)) {
                throw new RuntimeException('STARTTLS negotiation failed');
            }
            $this->ehlo(); // capabilities can change after TLS
        }
    }

    private function ehlo(): void
    {
        $helo = $this->config['helo'] ?? (gethostname() ?: 'localhost');
        $lines = $this->command("EHLO {$helo}", [250]);
        $this->capabilities = array_map(fn ($l) => strtoupper(substr($l, 4)), $lines);
    }

    private function authenticate(): void
    {
        $user = $this->config['username'] ?? '';
        if ($user === '') {
            return;
        }
        $pass = $this->config['password'] ?? '';
        $auth = implode(' ', array_filter($this->capabilities, fn ($c) => str_starts_with($c, 'AUTH')));

        if (str_contains($auth, 'PLAIN') || $auth === '') {
            $this->command('AUTH PLAIN ' . base64_encode("\0{$user}\0{$pass}"), [235], secret: true);
        } else {
            $this->command('AUTH LOGIN', [334]);
            $this->command(base64_encode($user), [334], secret: true);
            $this->command(base64_encode($pass), [235], secret: true);
        }
    }

    private function buildMessage(array $from, array $to, string $subject, string $body, ?array $replyTo): string
    {
        $domain = substr(strrchr($from[0], '@'), 1);
        $headers = [
            'Date: ' . date(DATE_RFC2822),
            'From: ' . $this->address($from),
            'To: ' . $this->address($to),
        ];
        if ($replyTo) {
            $headers[] = 'Reply-To: ' . $this->address($replyTo);
        }
        $headers[] = 'Subject: ' . $this->encodeHeader($subject);
        $headers[] = 'Message-ID: <' . bin2hex(random_bytes(16)) . "@{$domain}>";
        $headers[] = 'MIME-Version: 1.0';
        $headers[] = 'Content-Type: text/plain; charset=UTF-8';
        $headers[] = 'Content-Transfer-Encoding: base64';

        $body = str_replace(["\r\n", "\r"], "\n", $body);
        $encoded = rtrim(chunk_split(base64_encode(str_replace("\n", "\r\n", $body)), 76, "\r\n"));

        // Base64 never starts a line with ".", so no dot-stuffing is needed.
        return implode("\r\n", $headers) . "\r\n\r\n" . $encoded;
    }

    private function address(array $pair): string
    {
        $email = $pair[0];
        $name = trim(str_replace(["\r", "\n", '"'], '', $pair[1] ?? ''));
        return $name === '' ? "<{$email}>" : $this->encodeHeader($name) . " <{$email}>";
    }

    private function encodeHeader(string $value): string
    {
        $value = str_replace(["\r", "\n"], ' ', $value); // prevent header injection
        return preg_match('/[^\x20-\x7E]/', $value)
            ? '=?UTF-8?B?' . base64_encode($value) . '?='
            : $value;
    }

    /** @return list<string> response lines */
    private function command(string $line, array $expected, bool $secret = false): array
    {
        $this->write($line);
        return $this->expect($expected, $secret ? '[hidden]' : $line);
    }

    private function write(string $data): void
    {
        if (fwrite($this->socket, $data . "\r\n") === false) {
            throw new RuntimeException('Lost connection to SMTP server');
        }
    }

    /** @return list<string> */
    private function expect(array $codes, string $after = ''): array
    {
        $lines = [];
        while (($line = fgets($this->socket, 1024)) !== false) {
            $lines[] = rtrim($line, "\r\n");
            if (strlen($line) < 4 || $line[3] === ' ') {
                break; // last line of a (possibly multi-line) reply
            }
        }
        if (!$lines) {
            $meta = stream_get_meta_data($this->socket);
            throw new RuntimeException('No response from SMTP server' . ($meta['timed_out'] ? ' (timed out)' : ''));
        }
        $code = (int) substr(end($lines), 0, 3);
        if (!in_array($code, $codes, true)) {
            $context = $after !== '' ? " after \"{$after}\"" : '';
            throw new RuntimeException("Unexpected SMTP reply{$context}: " . implode(' | ', $lines));
        }
        return $lines;
    }

    private function disconnect(): void
    {
        if ($this->socket) {
            @fclose($this->socket);
            $this->socket = null;
        }
    }
}
