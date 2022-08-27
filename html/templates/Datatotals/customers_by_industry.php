<?php
/**
 * @var App\View\AppView $this
 * @var Cake\Collection\CollectionInterface $customersByIndustry
 */
?>
<div>
    <h3>業種ごとの顧客数</h3>
    <div class="mt-3"></div>
    <?= $this->element('table', [
        'headers' => [
            '業種',
            '顧客数'
        ],
        'rowCells' => $customersByIndustry->map(fn($data) => [
            h($data->business_category_name),
            h($data->count)
        ])->toArray(),
    ]) ?>
</div>