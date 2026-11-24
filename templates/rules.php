<?php /** @var ?array $page */ ?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <div class="rules">
    <?php foreach (Content::sections($page['body'] ?? '') as $rule): ?>
      <article class="rule-card">
        <h2><?= Markdown::inline($rule['title']) ?></h2>
        <?= $rule['html'] ?>
      </article>
    <?php endforeach ?>
  </div>
</div>
