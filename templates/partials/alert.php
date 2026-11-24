<?php /** @var ?array $page */ $m = $page['meta'] ?? []; if (empty($m['alert'])) return; ?>
<aside class="alert" role="note">
  <?php if (!empty($m['alert_title'])): ?><p class="alert-title"><?= e($m['alert_title']) ?></p><?php endif ?>
  <p><?= Markdown::inline($m['alert']) ?></p>
</aside>
