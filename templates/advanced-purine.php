<?php
/** @var Content $content @var ?array $page */
$order = ['low' => 0, 'medium' => 1, 'high' => 2];
$rows = $content->csv('advanced-purine');

// The source tables cap very high values at 999.9 / 999.99.
$num = function (string $value): string {
    if ($value === '') {
        return '<span class="muted" aria-label="not available">–</span>';
    }
    if ((float) $value >= 999.9) {
        return '<abbr title="Above the top of the measured scale">999+</abbr>';
    }
    return e(rtrim(rtrim(number_format((float) $value, 2, '.', ''), '0'), '.'));
};
?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <?php partial('purine-key') ?>
  <?php partial('table-tools', ['target' => 'advanced-table', 'total' => count($rows)]) ?>

  <div class="table-wrap">
    <table id="advanced-table" class="data-table data-table-numeric" data-filterable>
      <thead>
        <tr>
          <th scope="col"><button type="button" class="sort" data-sort="text" aria-sort="ascending">Food <?= icon('sort') ?></button></th>
          <th scope="col"><button type="button" class="sort" data-sort="level">Level <?= icon('sort') ?></button></th>
          <th scope="col" class="num"><button type="button" class="sort" data-sort="number">Total purines <small>mg uric acid / 100 g</small> <?= icon('sort') ?></button></th>
          <th scope="col" class="num"><button type="button" class="sort" data-sort="number">Min <?= icon('sort') ?></button></th>
          <th scope="col" class="num"><button type="button" class="sort" data-sort="number">Max <?= icon('sort') ?></button></th>
          <th scope="col" class="num"><button type="button" class="sort" data-sort="number">Nutrient density <small>mg / MJ</small> <?= icon('sort') ?></button></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $row): ?>
          <tr data-level="<?= e($row['level']) ?>">
            <td><?= e($row['food']) ?></td>
            <td data-value="<?= $order[$row['level']] ?? 9 ?>"><span class="level level-<?= e($row['level']) ?>"><?= e(level_label($row['level'])) ?></span></td>
            <td class="num" data-value="<?= e($row['total_purines']) ?>"><?= $num($row['total_purines']) ?></td>
            <td class="num" data-value="<?= e($row['min']) ?>"><?= $num($row['min']) ?></td>
            <td class="num" data-value="<?= e($row['max']) ?>"><?= $num($row['max']) ?></td>
            <td class="num" data-value="<?= e($row['nutrient_density']) ?>"><?= $num($row['nutrient_density']) ?></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <p class="empty-state" hidden data-empty>No foods match that search.</p>
  </div>

  <?php if (!empty($page['html'])): ?>
    <div class="prose notes"><?= $page['html'] ?></div>
  <?php endif ?>
</div>
