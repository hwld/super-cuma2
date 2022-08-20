<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale[] $sales
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
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('purchase_date', '購入日') ?>
                    </th>
                    <th><?= $this->Paginator->sort('Customers.name', '顧客名') ?>
                    </th>
                    <th><?= $this->Paginator->sort('Products.product_name', '製品名') ?>
                    </th>
                    <th><?= $this->Paginator->sort('amount', '個数') ?>
                    </th>
                    <th><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($sales as $sale): ?>
                <tr>
                    <td><?= $sale->purchase_date->i18nFormat('y-MM-d') ?>
                    </td>
                    <td><?= $sale->has('customer') ? h($sale->customer->name) : '不明' ?>
                    </td>
                    <td><?= $sale->has('product') ? h($sale->product->product_name) : '' ?>
                    </td>
                    <td><?= $this->Number->format($sale->amount) ?>
                    </td>
                    <td>
                        <?= $this->Html->link(__('更新'), ['action' => 'edit', $sale->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $sale->id], [
                            'confirm' => __('売上情報を削除してもよろしいですか?', $sale->id),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element('paginator') ?>
</div>