<?php
/** @var array $site @var string $slug */
$current = '/' . $slug;
$isActive = fn (array $item) => isset($item['path'])
    ? $item['path'] === $current
    : in_array($current, array_column($item['children'] ?? [], 'path'), true);
?>
<header class="site-header">
  <div class="container header-inner">
    <a class="brand" href="/">
      <svg class="brand-mark" viewBox="0 0 32 32" aria-hidden="true">
        <circle cx="16" cy="16" r="15" fill="var(--surface)" stroke="currentColor" stroke-width="2"/>
        <circle cx="11" cy="11" r="3" fill="currentColor"/>
        <circle cx="20" cy="19" r="3.5" fill="currentColor"/><circle cx="10" cy="21" r="2" fill="currentColor"/>
        <circle cx="21" cy="9" r="2" fill="currentColor"/>
      </svg>
      <span><?= e($site['name']) ?></span>
    </a>

    <button class="icon-button nav-toggle" type="button" aria-expanded="false" aria-controls="site-nav" aria-label="Menu">
      <?= icon('menu') ?>
    </button>

    <nav id="site-nav" class="site-nav" aria-label="Main">
      <ul>
        <?php foreach ($site['nav'] as $item): ?>
          <?php if (isset($item['children'])): ?>
            <li class="has-menu">
              <details class="menu">
                <summary class="<?= $isActive($item) ? 'is-active' : '' ?>"><?= e($item['label']) ?> <?= icon('chevron') ?></summary>
                <ul>
                  <?php foreach ($item['children'] as $child): ?>
                    <li><a href="<?= e($child['path']) ?>" <?= $child['path'] === $current ? 'aria-current="page"' : '' ?>><?= e($child['label']) ?></a></li>
                  <?php endforeach ?>
                </ul>
              </details>
            </li>
          <?php else: ?>
            <li><a href="<?= e($item['path']) ?>" <?= $isActive($item) ? 'aria-current="page"' : '' ?>><?= e($item['label']) ?></a></li>
          <?php endif ?>
        <?php endforeach ?>
      </ul>
      <button class="icon-button theme-toggle" type="button" aria-label="Toggle dark mode" title="Toggle dark mode">
        <span class="when-light"><?= icon('moon') ?></span>
        <span class="when-dark"><?= icon('sun') ?></span>
      </button>
    </nav>
  </div>
</header>
