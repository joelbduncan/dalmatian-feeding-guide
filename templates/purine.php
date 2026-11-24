<?php
/** @var Content $content @var ?array $page */
$order = ['low' => 0, 'medium' => 1, 'high' => 2];
$rows = $content->csv('purine');
usort($rows, fn ($a, $b) => [$order[$a['level']] ?? 9, strtolower($a['food'])] <=> [$order[$b['level']] ?? 9, strtolower($b['food'])]);
?>
<?php partial('page-header', ['page' => $page]) ?>
<div class="container section section-tight">
  <?php partial('purine-key') ?>
  <?php partial('table-tools', ['target' => 'purine-table', 'total' => count($rows)]) ?>

  <div class="table-wrap">
    <table id="purine-table" class="data-table" data-filterable>
      <thead>
        <tr>
          <th scope="col"><button type="button" class="sort" data-sort="text">Food <?= icon('sort') ?></button></th>
          <th scope="col"><button type="button" class="sort" data-sort="level" aria-sort="ascending">Purine level <?= icon('sort') ?></button></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($rows as $row): ?>
          <tr data-level="<?= e($row['level']) ?>">
            <td>
              <?= e($row['food']) ?>
              <?php if (!empty($row['notes'])): ?><span class="row-note"><?= e($row['notes']) ?></span><?php endif ?>
            </td>
            <td data-value="<?= $order[$row['level']] ?? 9 ?>"><span class="level level-<?= e($row['level']) ?>"><?= e(level_label($row['level'])) ?></span></td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
    <p class="empty-state" hidden data-empty>No foods match that search. <a href="/contact">Tell us what's missing</a>.</p>
  </div>

  <?php if (!empty($page['html'])): ?>
    <div class="prose notes"><?= $page['html'] ?></div>
  <?php endif ?>
</div>
