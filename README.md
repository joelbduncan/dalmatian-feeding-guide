# Dalmatian Feeding Guide

A low-purine feeding guide for Dalmatians. It's plain PHP 8.1+ with no database, no Composer and no build step. All content lives in Markdown and CSV files.

## Run it locally

```bash
php -S localhost:8000 -t public public/index.php
```

Then open http://localhost:8000.

## Where things live

```
config.php                  Site name, nav, analytics, Buy Me a Coffee, SMTP defaults
config.local.php            Your SMTP login and contact address (not committed)
content/
  pages/*.md                One file per page (title, intro and body text)
  data/purine.csv           Simple purine table:   food, level, notes (optional)
  data/advanced-purine.csv  Advanced table:        food, level, total_purines, min, max, nutrient_density
  dry-food/*.md             One file per dry food (front matter + ingredients)
  friends/*.md              One file per friend (front matter + description)
public/                     Web root: index.php, assets/, img/
templates/                  PHP templates and partials
lib/                        Content loader and a small Markdown renderer
```

`level` is always `low`, `medium` or `high`.

## Editing content

**Pages.** Edit the Markdown below the `---` front matter. On the FAQ and Three Rules pages, each `## Heading` becomes a separate question or rule card.

**Purine tables.** Open the CSV in Excel, Numbers or Google Sheets, edit, and save as CSV. Leave `min`/`max` blank when unknown. Values of 999.9 or more display as "999+".

**Add a dry food.** Copy a file in `content/dry-food/`, change the front matter, and put the image in `public/img/`:

```markdown
---
title: Adult Large Lamb & Rice
brand: Wainwright's
order: 4                       # position on the page
image: /img/my-image.jpg       # 7:4 ratio works best (e.g. 700×400)
summary: One-line description.
highlight: 50% lamb            # optional badge
---

**Composition:** …
```

**Add a friend.** Same idea in `content/friends/`. Optional keys: `website`, `facebook`, `instagram`, `twitter`, `cta_label`, `cta_url`.

**Add a new page.** Create `content/pages/my-page.md`, add `'my-page' => 'page'` to `$routes` in `public/index.php`, and add it to `nav` in `config.php`.

## Deploying

Upload everything and point the web root at `public/`, so `content/`, `templates/` and `config.php` can't be reached directly.

- **Nginx:** see `nginx.conf` (the live server config).
- **Apache:** `public/.htaccess` is already included.

Old `.php` URLs (e.g. `/three-rules.php`) redirect permanently to the clean URLs.

## Contact form

The contact form sends email over SMTP using a small built-in mailer, so you don't need Composer or PHP's `mail()` function.

1. Copy `config.local.example.php` to `config.local.php`. It's git-ignored, so the password stays out of the repo.
2. Fill in your SMTP host, port, username, password, `from_email` and the `contact.to` address that messages should go to.
3. Use port 587 with `'encryption' => 'tls'`, or port 465 with `'ssl'`.

Messages are sent **from** your own address (`from_email`), and the visitor's address is set as **Reply-To**, so hitting Reply goes to them. Sending from your own domain keeps the email from being flagged as spoofed (SPF/DMARC).

Built-in spam protection: a CSRF token, a hidden honeypot field, a minimum fill time, and one message per minute per visitor. SMTP errors are written to the PHP error log, and the visitor sees a polite "try again later" message.

The form stays hidden, with a short notice in its place, until the SMTP host, `from_email` and `contact.to` are set.
