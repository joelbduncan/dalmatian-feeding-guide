<?php
/** @var array $site @var Content $content @var ?array $page */
$meta = $page['meta'] ?? [];
$title = null; // home uses the bare site name
$guides = ['three-rules', 'purine-guide', 'advanced-purine-guide', 'dry-food-guide', 'treats', 'water-and-urine'];
$health = ['warning-signs', 'dna-testing'];
?>
<section class="hero">
  <div class="hero-media" aria-hidden="true">
    <img src="/img/zeus-dalmatian-cover.jpg" alt="" width="2400" height="1067" fetchpriority="high">
  </div>
  <div class="container hero-content">
    <p class="eyebrow"><?= e($meta['eyebrow'] ?? 'Welcome') ?></p>
    <h1><?= e($meta['heading'] ?? $site['tagline']) ?></h1>
    <p class="lead"><?= e($meta['lead'] ?? '') ?></p>
    <div class="button-row">
      <a class="button" href="/purine-guide">Check a food <?= icon('arrow') ?></a>
      <a class="button button-ghost on-dark" href="#why">Why it matters</a>
    </div>
  </div>
</section>

<div class="container">
  <a class="emergency-strip" href="/warning-signs">
    <strong>Is your Dalmatian straining to pee?</strong>
    <span>It can be an emergency. Read the warning signs <?= icon('arrow') ?></span>
  </a>
</div>

<section class="container section">
  <h2 class="section-title">Guides</h2>
  <div class="card-grid card-grid-wide">
    <?php foreach ($guides as $i => $guide):
        $g = $content->page($guide)['meta'] ?? []; ?>
      <a class="card card-link" href="/<?= e($guide) ?>">
        <span class="card-number"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT) ?></span>
        <h3><?= e($g['title'] ?? $guide) ?></h3>
        <p><?= e($g['summary'] ?? '') ?></p>
        <span class="card-cta">Open guide <?= icon('arrow') ?></span>
      </a>
    <?php endforeach ?>
  </div>
</section>

<section class="container section section-tight">
  <h2 class="section-title">Health</h2>
  <div class="two-up">
    <?php foreach ($health as $h):
        $g = $content->page($h)['meta'] ?? []; ?>
      <a class="card card-link" href="/<?= e($h) ?>">
        <h3><?= e($g['title'] ?? $h) ?></h3>
        <p><?= e($g['summary'] ?? '') ?></p>
        <span class="card-cta">Read more <?= icon('arrow') ?></span>
      </a>
    <?php endforeach ?>
  </div>
</section>

<section id="why" class="section section-alt">
  <div class="container split">
    <div class="prose">
      <?= $page['html'] ?? '' ?>
    </div>
    <figure class="split-media">
      <img src="/img/dalmatian-why-it-matters.jpg" alt="A healthy Dalmatian" loading="lazy">
    </figure>
  </div>
</section>
