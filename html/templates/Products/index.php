<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div class="products index content">
    <h3><?= __('製品一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link('追加', ['action' => 'add'], ['class' => 'btn btn-primary py-1 px-3']) ?>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-sm table-bordered">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('product_name', '製品名') ?>
                    </th>
                    <th><?= $this->Paginator->sort('unit_price','単価') ?>
                    </th>
                    <th><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                <tr>
                    <td><?= h($product->product_name) ?>
                    </td>
                    <td><?= $this->Number->format($product->unit_price) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('更新'), ['action' => 'edit', $product->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $product->id], [
                            'confirm' => __('製品 {0} を削除してもよろしいですか?', $product->id),
                            'class' => 'btn btn-sm btn-danger'
                        ])?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element('paginator') ?>
</div>