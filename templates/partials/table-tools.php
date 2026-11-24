<?php /** @var string $target @var int $total */ ?>
<div class="table-tools" data-table-tools="<?= e($target) ?>">
  <label class="search-field">
    <?= icon('search') ?>
    <span class="visually-hidden">Search foods</span>
    <input type="search" placeholder="Search foods…" autocomplete="off" data-search>
  </label>
  <div class="chips" role="group" aria-label="Filter by purine level">
    <button type="button" class="chip" data-level="" aria-pressed="true">All</button>
    <button type="button" class="chip chip-low" data-level="low" aria-pressed="false">Low</button>
    <button type="button" class="chip chip-medium" data-level="medium" aria-pressed="false">Moderate</button>
    <button type="button" class="chip chip-high" data-level="high" aria-pressed="false">High</button>
  </div>
  <p class="table-count muted" aria-live="polite" data-count><?= $total ?> foods</p>
</div>
