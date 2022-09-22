<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $sales
 * @var boolean $canAdd
 */

use App\Model\Entity\Sale;

?>
<div>
    <h3><?= __('売上一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary'
        ]) ?>
        <?php endif; ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
        'noDataText' => '売上が存在しません。<br>右上の追加ボタンから売上を登録してください。</br>',
        'headers' => [
            $this->Paginator->sort('purchase_date', '購入日'),
            $this->Paginator->sort('Customers.name', '顧客名'),
            $this->Paginator->sort('Products.product_name', '製品名'),
            $this->Paginator->sort('amount', '個数'),
            '操作'
        ],
        'rowCells' => $sales->map(function ($sale) {
            $sale_data = $sale['data'];
            assert($sale_data instanceof Sale);
            $canEdit = $sale['permissions']['canEdit'];
            $canDelete = $sale['permissions']['canDelete'];

            $updateButton = $canEdit ?
                $this->element('tableActionLink', [
                    'text' => '更新',
                    'url' => ['action' => 'edit', $sale_data->id],
                    'type' => 'edit',
                    'class' => 'ms-1'
                ]) : null;

            $deleteButton = $canDelete ?
                $this->element('tableActionPostLink', [
                    'text' => '削除',
                    'confirm' => "売上情報を削除してもよろしいですか？",
                    'url' => ['action' => 'delete', $sale_data->id],
                    'type' => 'delete',
                    'class' => 'ms-1',
                ]) : null;

            return [
                $sale_data->purchase_date->i18nFormat('y-MM-d'),
                $sale_data->has('customer') ? h($sale_data->customer->name) : '不明',
                $sale_data->has('product') ? h($sale_data->product->product_name) : '',
                $this->Number->format($sale_data->amount),
                $updateButton . $deleteButton
            ];
        })->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>