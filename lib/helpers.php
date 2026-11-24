<?php

declare(strict_types=1);

/** Escape a value for HTML output. */
function e(mixed $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/** Absolute path of a file in public/, with a cache-busting version. */
function asset(string $path): string
{
    $file = APP_ROOT . '/public/' . ltrim($path, '/');
    $version = is_file($file) ? substr(md5((string) filemtime($file)), 0, 8) : '';
    return '/' . ltrim($path, '/') . ($version ? "?v={$version}" : '');
}

/**
 * Render a template inside the shared layout.
 * The template can set $title, $description and $bodyClass for the layout.
 */
function render(string $template, array $vars): void
{
    extract($vars);
    $title = $page['meta']['title'] ?? null;
    $description = $page['meta']['description'] ?? null;
    $bodyClass = "page-{$template}";

    ob_start();
    require APP_ROOT . "/templates/{$template}.php";
    $main = ob_get_clean();

    require APP_ROOT . '/templates/layout.php';
}

/** Render a partial template. */
function partial(string $name, array $vars = []): void
{
    extract($vars);
    require APP_ROOT . "/templates/partials/{$name}.php";
}

/** Inline SVG icon from the small set the site uses. */
function icon(string $name): string
{
    $paths = [
        'sun'      => '<circle cx="12" cy="12" r="4"/><path d="M12 2v2M12 20v2M4.9 4.9l1.4 1.4M17.7 17.7l1.4 1.4M2 12h2M20 12h2M4.9 19.1l1.4-1.4M17.7 6.3l1.4-1.4"/>',
        'moon'     => '<path d="M21 12.8A9 9 0 1 1 11.2 3a7 7 0 0 0 9.8 9.8z"/>',
        'menu'     => '<path d="M3 6h18M3 12h18M3 18h18"/>',
        'search'   => '<circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/>',
        'arrow'    => '<path d="M5 12h14M13 6l6 6-6 6"/>',
        'external' => '<path d="M14 4h6v6M20 4l-9 9M18 14v5a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h5"/>',
        'globe'    => '<circle cx="12" cy="12" r="9"/><path d="M3 12h18M12 3a14 14 0 0 1 0 18M12 3a14 14 0 0 0 0 18"/>',
        'heart'    => '<path d="M12 20s-7-4.4-7-10a4 4 0 0 1 7-2.6A4 4 0 0 1 19 10c0 5.6-7 10-7 10z"/>',
        'bag'      => '<path d="M5 8h14l-1 12H6L5 8z"/><path d="M9 8V6a3 3 0 0 1 6 0v2"/>',
        'chevron'  => '<path d="m6 9 6 6 6-6"/>',
        'sort'     => '<path d="m8 9 4-4 4 4M8 15l4 4 4-4"/>',
        'coffee'   => '<path d="M4 8h13v5a5 5 0 0 1-5 5H9a5 5 0 0 1-5-5V8z"/><path d="M17 9h1.5a2.5 2.5 0 0 1 0 5H17M8 2v3M12 2v3"/>',
    ];
    $svg = $paths[$name] ?? '';
    return '<svg class="icon" viewBox="0 0 24 24" aria-hidden="true" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">' . $svg . '</svg>';
}

/** Human labels for purine levels. */
function level_label(string $level): string
{
    return ['low' => 'Low', 'medium' => 'Moderate', 'high' => 'High'][$level] ?? ucfirst($level);
}
