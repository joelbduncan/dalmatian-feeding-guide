<?php
/** @var Content $content @var ?array $page */
$linkTypes = [
    'website'   => ['Website', 'globe'],
    'facebook'  => ['Facebook', 'external'],
    'instagram' => ['Instagram', 'external'],
    'twitter'   => ['X (Twitter)', 'external'],
];
?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <div class="friends-grid">
    <?php foreach ($content->collection('friends') as $friend): $m = $friend['meta']; ?>
      <article class="card friend">
        <?php if (!empty($m['image'])): ?>
          <img class="card-image" src="<?= e($m['image']) ?>" alt="" width="800" height="400" loading="lazy">
        <?php endif ?>
        <div class="card-body">
          <h2 class="card-title"><?= e($m['title'] ?? $friend['slug']) ?></h2>
          <div class="prose"><?= $friend['html'] ?></div>
          <div class="link-row">
            <?php if (!empty($m['cta_url'])): ?>
              <a class="button" href="<?= e($m['cta_url']) ?>" rel="noopener" target="_blank">
                <?= icon(($m['cta_label'] ?? '') === 'Donate' ? 'heart' : 'bag') ?> <?= e($m['cta_label'] ?? 'Visit') ?>
              </a>
            <?php endif ?>
            <?php foreach ($linkTypes as $key => [$label, $ic]): if (empty($m[$key])) continue; ?>
              <a class="button button-small button-ghost" href="<?= e($m[$key]) ?>" rel="noopener" target="_blank"><?= icon($ic) ?> <?= e($label) ?></a>
            <?php endforeach ?>
          </div>
        </div>
      </article>
    <?php endforeach ?>
  </div>
</div>
