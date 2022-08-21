<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $sales
 */
?>
<div>
    <h3><?= __('売上一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary px-3 py-1'
        ]) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
        'headers' => [
            $this->Paginator->sort('purchase_date', '購入日'),
            $this->Paginator->sort('Customers.name', '顧客名'),
            $this->Paginator->sort('Products.product_name', '製品名'),
            $this->Paginator->sort('amount', '個数'),
            '操作'
        ],
        'rowCells' => $sales->map(fn($sale)=>[
            $sale->purchase_date->i18nFormat('y-MM-d'),
            $sale->has('customer') ? h($sale->customer->name) : '不明',
            $sale->has('product') ? h($sale->product->product_name) : '',
            $this->Number->format($sale->amount),
            $this->Html->link(__('更新'), ['action' => 'edit', $sale->id], [
                'class' => 'btn btn-sm btn-secondary'
            ]).' '.
            $this->Form->postLink(__('削除'), ['action' => 'delete', $sale->id], [
                'confirm' => __('売上情報を削除してもよろしいですか?', $sale->id),
                'class' => 'btn btn-sm btn-danger'
            ])
        ])->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>