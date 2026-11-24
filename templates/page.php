<?php /** @var ?array $page @var string $slug */ ?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <?php partial('alert', ['page' => $page]) ?>
  <article class="prose prose-<?= e($slug) ?>">
    <?= $page['html'] ?? '' ?>
  </article>
</div>
