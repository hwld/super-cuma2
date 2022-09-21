<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $ranking
 */
?>
<div>
    <h3>製品別売上ランキング</h3>
    <div class="mt-3"></div>
    <?= $this->element('table', [
        'noDataText' => '集計データが存在しません。',
        'headers' => [
            'ランキング',
            '製品名',
            '単価',
            '売上個数',
            '売上合計金額',
        ],
        'rowCells' => $ranking->map(function ($data) {
            return [
                h($data->ranking),
                h($data->product_name),
                h($data->unit_price),
                h($data->total_quantity),
                h($data->total_price),
            ];
        })->toArray()
    ]) ?>
</div>