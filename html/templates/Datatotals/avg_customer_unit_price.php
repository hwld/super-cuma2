<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $customerUnitPrice
 */
?>
<div>
    <h3>平均顧客単価</h3>
    <div class="mt-3"></div>
    <?= $this->element('table', [
        'noDataText' => '集計データが存在しません。',
        'headers' => [
            '顧客名',
            '単価'
        ],
        'rowCells' => $customerUnitPrice->map(function ($data) {
            return [
                h($data->name),
                h($data->unit_price)
            ];
        })->toArray()
    ]) ?>
</div>