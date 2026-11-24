<?php /** @var array $site */ ?>
<footer class="site-footer">
  <div class="container footer-inner">
    <div>
      <p class="footer-brand"><?= e($site['name']) ?></p>
      <p class="muted">Free, ad-free and community-driven. This guide isn't a substitute for advice from your vet.</p>
    </div>
    <div>
      <p class="footer-heading">Useful links</p>
      <ul class="plain-list">
        <?php foreach ($site['useful_links'] as $link): ?>
          <li><a href="<?= e($link['url']) ?>" rel="noopener" target="_blank"><?= e($link['label']) ?></a></li>
        <?php endforeach ?>
        <li><a href="/contact">Suggest a correction</a></li>
      </ul>
    </div>
    <div class="footer-credit">
      <p class="muted">Made with <span class="heart" aria-label="love"><?= icon('heart') ?></span> by <a href="<?= e($site['author_url']) ?>"><?= e($site['author']) ?></a></p>
      <?php if ($site['buymeacoffee']): ?>
        <a class="button button-small button-ghost" href="https://www.buymeacoffee.com/<?= e($site['buymeacoffee']) ?>" rel="noopener" target="_blank"><?= icon('coffee') ?> Buy me a coffee</a>
      <?php endif ?>
    </div>
  </div>
</footer>
