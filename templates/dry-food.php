<?php /** @var Content $content @var ?array $page */ ?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <?php if (!empty($page['html'])): ?>
    <aside class="callout"><?= $page['html'] ?></aside>
  <?php endif ?>

  <?php
  $foods = $content->collection('dry-food');
  $groups = [
      'everyday' => array_filter($foods, fn ($f) => ($f['meta']['category'] ?? '') !== 'prescription'),
      'prescription' => array_filter($foods, fn ($f) => ($f['meta']['category'] ?? '') === 'prescription'),
  ];
  ?>
  <?php foreach ($groups as $group => $items): if (!$items) continue; ?>
  <?php if ($group === 'prescription'): ?>
    <section class="food-group" id="prescription-diets">
      <h2>Prescription diets</h2>
      <p class="muted">These veterinary diets are made for dogs with urate stones or a high risk of them. Only use them on your vet's advice. Avoid giving other foods or treats alongside them, because extras can undo their effect.</p>
  <?php endif ?>
  <div class="card-grid card-grid-wide">
    <?php foreach ($items as $food): $m = $food['meta']; ?>
      <article class="card product">
        <?php if (!empty($m['image'])): ?>
          <img class="card-image" src="<?= e($m['image']) ?>" alt="<?= e($m['title'] ?? '') ?>" loading="lazy" width="700" height="400">
        <?php endif ?>
        <div class="card-body">
          <?php if (!empty($m['brand'])): ?><p class="eyebrow"><?= e($m['brand']) ?></p><?php endif ?>
          <h2 class="card-title"><?= e($m['title'] ?? $food['slug']) ?></h2>
          <p><?= e($m['summary'] ?? '') ?></p>
          <?php if (!empty($m['highlight'])): ?><p class="tag"><?= e($m['highlight']) ?></p><?php endif ?>
          <?php if (!empty($m['url'])): ?>
            <p><a class="button button-small button-ghost" href="<?= e($m['url']) ?>" rel="noopener" target="_blank"><?= icon('external') ?> View product</a></p>
          <?php endif ?>
          <details class="disclosure">
            <summary><?= ($m['category'] ?? '') === 'prescription' ? 'Details' : 'Ingredients' ?> <?= icon('chevron') ?></summary>
            <div class="prose prose-small"><?= $food['html'] ?></div>
          </details>
        </div>
      </article>
    <?php endforeach ?>
  </div>
  <?php if ($group === 'prescription'): ?></section><?php endif ?>
  <?php endforeach ?>
</div>
