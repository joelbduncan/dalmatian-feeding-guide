<?php /** @var ?array $page @var ?string $fallbackTitle */ $meta = $page['meta'] ?? []; ?>
<header class="page-header">
  <div class="container">
    <?php if (!empty($meta['eyebrow'])): ?><p class="eyebrow"><?= e($meta['eyebrow']) ?></p><?php endif ?>
    <h1><?= e($meta['title'] ?? $fallbackTitle ?? '') ?></h1>
    <?php if (!empty($meta['intro'])): ?><p class="lead"><?= e($meta['intro']) ?></p><?php endif ?>
  </div>
</header>
