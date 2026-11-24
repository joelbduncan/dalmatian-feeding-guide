<?php

declare(strict_types=1);

require_once __DIR__ . '/Markdown.php';

/**
 * Loads flat-file content from the content/ directory.
 *
 * Markdown files may start with front matter: simple `key: value` lines
 * between two `---` lines. Values are plain strings.
 */
final class Content
{
    public function __construct(private string $root)
    {
    }

    /** @return array{meta: array<string,string>, body: string, html: string}|null */
    public function page(string $name): ?array
    {
        $file = "{$this->root}/pages/{$name}.md";
        return is_file($file) ? $this->parseFile($file) : null;
    }

    /**
     * Every Markdown file in a folder, sorted by the `order` front-matter
     * field and then by title.
     *
     * @return list<array{slug: string, meta: array<string,string>, body: string, html: string}>
     */
    public function collection(string $folder): array
    {
        $items = [];
        foreach (glob("{$this->root}/{$folder}/*.md") ?: [] as $file) {
            $items[] = ['slug' => basename($file, '.md')] + $this->parseFile($file);
        }
        usort($items, fn ($a, $b) =>
            [(int) ($a['meta']['order'] ?? 999), $a['meta']['title'] ?? $a['slug']]
            <=> [(int) ($b['meta']['order'] ?? 999), $b['meta']['title'] ?? $b['slug']]);
        return $items;
    }

    /** @return list<array<string,string>> rows keyed by the header row */
    public function csv(string $name): array
    {
        $file = "{$this->root}/data/{$name}.csv";
        if (!is_file($file) || !($handle = fopen($file, 'r'))) {
            return [];
        }
        $header = fgetcsv($handle, escape: '');
        $rows = [];
        while (($row = fgetcsv($handle, escape: '')) !== false) {
            if ($row === [null] || count($row) !== count($header)) {
                continue; // skip blank or malformed lines
            }
            $rows[] = array_combine($header, array_map('trim', $row));
        }
        fclose($handle);
        return $rows;
    }

    /**
     * Split Markdown into sections on `## ` headings (used by the FAQ).
     *
     * @return list<array{title: string, html: string}>
     */
    public static function sections(string $markdown): array
    {
        $parts = preg_split('/^##\s+/m', "\n" . $markdown);
        array_shift($parts);
        return array_map(function ($part) {
            [$title, $body] = array_pad(explode("\n", $part, 2), 2, '');
            return ['title' => trim($title), 'html' => Markdown::render($body)];
        }, $parts);
    }

    /** @return array{meta: array<string,string>, body: string, html: string} */
    private function parseFile(string $file): array
    {
        $raw = str_replace("\r\n", "\n", (string) file_get_contents($file));
        $meta = [];
        if (preg_match('/^---\n(.*?)\n---\n?(.*)$/s', $raw, $m)) {
            foreach (explode("\n", $m[1]) as $line) {
                if (preg_match('/^([A-Za-z0-9_-]+)\s*:\s*(.*)$/', $line, $kv)) {
                    $meta[$kv[1]] = trim($kv[2], " \t\"'");
                }
            }
            $raw = $m[2];
        }
        return ['meta' => $meta, 'body' => $raw, 'html' => Markdown::render($raw)];
    }
}
