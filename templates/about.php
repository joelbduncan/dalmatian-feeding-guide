<?php /** @var ?array $page */ $m = $page['meta'] ?? []; ?>
<?php partial('page-header', ['page' => $page]) ?>

<div class="container section section-tight">
  <div class="about-story">
    <article class="prose">
      <?= $page['html'] ?? '' ?>
    </article>
    <figure class="about-photo">
      <img src="/img/zeus-puppy.jpg" alt="Zeus as a puppy: a Dalmatian with blue eyes, lying in a brown bed" width="720" height="540">
      <figcaption>Zeus as a puppy</figcaption>
    </figure>
  </div>
</div>

<?php if (!empty($m['memorial'])): ?>
<section class="memorial">
  <div class="container memorial-inner">
    <figure class="memorial-photo">
      <img src="/img/zeus-portrait.jpg" alt="Portrait of Zeus, a grown Dalmatian with pale blue eyes, against a dark background" width="1000" height="1500" loading="lazy">
    </figure>
    <div class="memorial-text">
      <h2><?= e($m['memorial_title'] ?? 'In memory') ?></h2>
      <p><?= Markdown::inline($m['memorial']) ?></p>
    </div>
  </div>
</section>
<?php endif ?>
