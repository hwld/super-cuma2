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
                    $this->element('tableActionLink', [
                        'text' => '更新',
                        'url' => ['action' => 'edit', $product->id],
                        'type' => 'edit',
                    ]) : null;

                $deleteButton = $canDelete ?
                    $this->element('tableActionPostLink', [
                        'text' => '削除',
                        'confirm' => "製品 {$product->product_name} を削除してもよろしいですか？",
                        'url' => ['action' => 'delete', $product->id],
                        'type' => 'delete',
                        'class' => 'ms-1'
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