<?php /** @var ?array $page */ ?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight narrow">
  <div class="faq-list">
    <?php foreach (Content::sections($page['body'] ?? '') as $i => $item): ?>
      <details class="faq-item" <?= $i === 0 ? 'open' : '' ?>>
        <summary><?= Markdown::inline($item['title']) ?> <?= icon('chevron') ?></summary>
        <div class="prose"><?= $item['html'] ?></div>
      </details>
    <?php endforeach ?>
  </div>
  <p class="muted center">Got a question that isn't here? <a href="/contact">Ask us</a>.</p>
</div>
