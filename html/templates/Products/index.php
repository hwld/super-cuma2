<?php
/**
 * @var \App\View\AppView $this
 * @var Cake\Collection\CollectionInterface $products
 * @var boolean $canAdd
 */
?>
<div class="products index content">
    <h3><?= __('製品一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link('追加', ['action' => 'add'], ['class' => 'btn btn-primary py-1 px-3']) ?>
        <?php endif; ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
            'headers' => [
                $this->Paginator->sort('product_name', '製品名'),
                $this->Paginator->sort('unit_price', '単価'),
                '操作'
            ],
            'rowCells' => $products->map(function ($product) {
                $product_data = $product['data'];
                $canEdit = $product['permissions']['canEdit'];
                $canDelete = $product['permissions']['canDelete'];

                $editButton = $canEdit ?
                    $this->Html->link('更新', ['action' => 'edit', $product_data->id], [
                        'class' => 'btn btn-sm border'
                    ]) : null;

                $deleteButton = $canDelete ?
                    $this->Form->postLink(__('削除'), ['action' => 'delete', $product_data->id], [
                        'confirm' => __('製品 {0} を削除してもよろしいですか?', $product_data->id),
                        'class' => 'btn btn-sm border ms-1'
                    ]) : null;

                return [
                    h($product_data->product_name),
                    $this->Number->format($product_data->unit_price),
                    $editButton . $deleteButton
                ];
            })->toArray()
    ]) ?>
    <?= $this->element('paginator') ?>
</div>