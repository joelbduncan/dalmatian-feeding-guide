<?php

declare(strict_types=1);

/**
 * A small, dependency-free Markdown renderer covering what this site needs:
 * headings, paragraphs, bold/italic, links, inline code, lists, blockquotes
 * and horizontal rules. All text is HTML-escaped, so content files can't
 * inject markup.
 */
final class Markdown
{
    public static function render(string $markdown): string
    {
        $lines = preg_split('/\R/', trim($markdown)) ?: [];
        $html = [];
        $paragraph = [];
        $list = null;      // 'ul' | 'ol' | null
        $listItems = [];
        $quote = [];

        $flushParagraph = function () use (&$paragraph, &$html) {
            if ($paragraph) {
                $html[] = '<p>' . self::inline(implode(' ', $paragraph)) . '</p>';
                $paragraph = [];
            }
        };
        $flushList = function () use (&$list, &$listItems, &$html) {
            if ($list) {
                $items = array_map(fn ($i) => '<li>' . self::inline($i) . '</li>', $listItems);
                $html[] = "<{$list}>" . implode('', $items) . "</{$list}>";
                $list = null;
                $listItems = [];
            }
        };
        $flushQuote = function () use (&$quote, &$html) {
            if ($quote) {
                $html[] = '<blockquote>' . self::render(implode("\n", $quote)) . '</blockquote>';
                $quote = [];
            }
        };
        $flushAll = function () use ($flushParagraph, $flushList, $flushQuote) {
            $flushParagraph();
            $flushList();
            $flushQuote();
        };

        foreach ($lines as $line) {
            $trimmed = trim($line);

            if ($trimmed === '') {
                $flushAll();
                continue;
            }

            if (str_starts_with($trimmed, '>')) {
                $flushParagraph();
                $flushList();
                $quote[] = ltrim(substr($trimmed, 1));
                continue;
            }
            $flushQuote();

            if (preg_match('/^(#{1,6})\s+(.+?)\s*#*$/', $trimmed, $m)) {
                $flushAll();
                $level = strlen($m[1]);
                $id = self::slug($m[2]);
                $html[] = "<h{$level} id=\"{$id}\">" . self::inline($m[2]) . "</h{$level}>";
                continue;
            }

            if (preg_match('/^(-{3,}|\*{3,}|_{3,})$/', $trimmed)) {
                $flushAll();
                $html[] = '<hr>';
                continue;
            }

            if (preg_match('/^[-*+]\s+(.*)$/', $trimmed, $m) || preg_match('/^\d+[.)]\s+(.*)$/', $trimmed, $m)) {
                $flushParagraph();
                $type = preg_match('/^\d/', $trimmed) ? 'ol' : 'ul';
                if ($list !== $type) {
                    $flushList();
                    $list = $type;
                }
                $listItems[] = $m[1];
                continue;
            }

            if ($list && preg_match('/^\s{2,}/', $line)) {
                // Continuation line of a list item.
                $listItems[count($listItems) - 1] .= ' ' . $trimmed;
                continue;
            }

            $flushList();
            $paragraph[] = $trimmed;
        }
        $flushAll();

        return implode("\n", $html);
    }

    public static function inline(string $text): string
    {
        $text = htmlspecialchars($text, ENT_QUOTES | ENT_HTML5, 'UTF-8', false);

        // Inline code and backslash escapes first so they aren't formatted.
        $codes = [];
        $text = preg_replace_callback('/\\\\([\\\\`*_\[\]()#+.!-])/', function ($m) use (&$codes) {
            $codes[] = $m[1];
            return "\x1A" . (count($codes) - 1) . "\x1A";
        }, $text);
        $text = preg_replace_callback('/`([^`]+)`/', function ($m) use (&$codes) {
            $codes[] = '<code>' . $m[1] . '</code>';
            return "\x1A" . (count($codes) - 1) . "\x1A";
        }, $text);

        // Links: [text](url "optional title")
        $text = preg_replace_callback('/\[([^\]]+)\]\(([^)\s]+)(?:\s+&quot;(.*?)&quot;)?\)/', function ($m) {
            $url = html_entity_decode($m[2], ENT_QUOTES | ENT_HTML5);
            if (!preg_match('#^(https?://|mailto:|/|\#|[a-z0-9-]+$)#i', $url)) {
                return $m[1];
            }
            $external = preg_match('#^https?://#i', $url);
            $attrs = $external ? ' rel="noopener" target="_blank"' : '';
            $title = isset($m[3]) && $m[3] !== '' ? ' title="' . $m[3] . '"' : '';
            return '<a href="' . htmlspecialchars($url, ENT_QUOTES) . '"' . $title . $attrs . '>' . $m[1] . '</a>';
        }, $text);

        $text = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $text);
        $text = preg_replace('/(?<![\w*])\*(?!\s)(.+?)(?<!\s)\*(?![\w*])/', '<em>$1</em>', $text);
        $text = preg_replace('/(?<!\w)_(?!\s)(.+?)(?<!\s)_(?!\w)/', '<em>$1</em>', $text);

        return preg_replace_callback("/\x1A(\d+)\x1A/", fn ($m) => $codes[(int) $m[1]], $text);
    }

    public static function slug(string $text): string
    {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9]+/', '-', strip_tags($text)), '-'));
        return $slug !== '' ? $slug : 'section';
    }
}
