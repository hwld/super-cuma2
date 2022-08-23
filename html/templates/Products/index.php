<?php
/**
 * @var \App\View\AppView $this
 * @var Cake\Collection\CollectionInterface $products
 */
?>
<div class="products index content">
    <h3><?= __('製品一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link('追加', ['action' => 'add'], ['class' => 'btn btn-primary py-1 px-3']) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
            'headers' => [
                $this->Paginator->sort('product_name', '製品名'),            
                $this->Paginator->sort('unit_price','単価'),
                '操作'
            ],
            'rowCells' => $products->map(fn($product) => [
                h($product->product_name),
                $this->Number->format($product->unit_price),
                $this->Html->link('更新', ['action' => 'edit', $product->id],[
                    'class' => 'btn btn-sm btn-secondary'
                ]).
                $this->Form->postLink(__('削除'), ['action' => 'delete', $product->id], [
                    'confirm' => __('製品 {0} を削除してもよろしいですか?', $product->id),
                    'class' => 'btn btn-sm btn-danger ms-1'
                ])
            ])->toArray()
    ]) ?>
    <?= $this->element('paginator') ?>
</div>