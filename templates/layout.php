<?php
/** @var array $site @var string $main @var ?string $title @var ?string $description @var string $bodyClass @var string $slug */
$fullTitle = $title && $slug !== '' ? "{$title} · {$site['name']}" : $site['name'];
$metaDescription = $description ?: $site['description'];
$canonical = rtrim($site['url'], '/') . '/' . $slug;
?>
<!doctype html>
<html lang="en-GB">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?= e($fullTitle) ?></title>
  <meta name="description" content="<?= e($metaDescription) ?>">
  <link rel="canonical" href="<?= e($canonical) ?>">
  <meta property="og:title" content="<?= e($fullTitle) ?>">
  <meta property="og:description" content="<?= e($metaDescription) ?>">
  <meta property="og:url" content="<?= e($canonical) ?>">
  <meta property="og:type" content="website">
  <meta property="og:image" content="<?= e(rtrim($site['url'], '/') . '/img/zeus-dalmatian-cover.jpg') ?>">
  <meta name="color-scheme" content="light dark">
  <link rel="icon" href="/favicon.svg" type="image/svg+xml">
  <script>
    // Apply the saved theme before first paint to avoid a flash.
    try { const t = localStorage.getItem('theme'); if (t) document.documentElement.dataset.theme = t; } catch (e) {}
  </script>
  <link rel="stylesheet" href="<?= e(asset('assets/css/site.css')) ?>">
  <script src="<?= e(asset('assets/js/site.js')) ?>" defer></script>
  <?php if ($site['plausible_domain']): ?>
  <script defer data-domain="<?= e($site['plausible_domain']) ?>" src="<?= e($site['plausible_script']) ?>"></script>
  <?php endif ?>
</head>
<body class="<?= e($bodyClass) ?>">
  <a class="skip-link" href="#main">Skip to content</a>
  <?php partial('header', ['site' => $site, 'slug' => $slug]) ?>
  <main id="main">
    <?= $main ?>
  </main>
  <?php partial('footer', ['site' => $site]) ?>
</body>
</html>
