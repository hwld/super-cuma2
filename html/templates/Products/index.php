<?php
/**
 * @var \App\View\AppView $this
 * @var array<Operable<Product>> $products
 * @var boolean $canAdd
 */

use App\Model\Entity\Product;
use App\ViewData\Operable;

?>
<div class="products index content">
    <h3><?= __('製品一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link('追加', ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
        <?php endif; ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
            'noDataText' => '製品が存在しません。<br>右上の追加ボタンから製品を追加してください。</br>',
            'headers' => [
                $this->Paginator->sort('product_name', '製品名'),
                $this->Paginator->sort('unit_price', '単価'),
                '操作'
            ],
            'rowCells' => array_map(function (Operable $operable) {
                $product = $operable->data;
                assert($product instanceof Product);
                $canEdit = $operable->canEdit;
                $canDelete = $operable->canDelete;

                $editButton = $canEdit ?
                    $this->Html->link('更新', ['action' => 'edit', $product->id], [
                        'class' => 'btn btn-sm border'
                    ]) : null;

                $deleteButton = $canDelete ?
                    $this->Form->postLink(__('削除'), ['action' => 'delete', $product->id], [
                        'confirm' => __('製品 {0} を削除してもよろしいですか?', $product->id),
                        'class' => 'btn btn-sm border ms-1'
                    ]) : null;

                return [
                    h($product->product_name),
                    $this->Number->format($product->unit_price),
                    $editButton . $deleteButton
                ];
            }, $products)
    ]) ?>
    <?= $this->element('paginator') ?>
</div>