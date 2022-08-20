<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<div>
    <h3><?= __('顧客一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
    </div>
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th><?= $this->Paginator->sort('customer_cd', '顧客コード') ?>
                    </th>
                    <th><?= $this->Paginator->sort('name', '名前') ?>
                    </th>
                    <th><?= $this->Paginator->sort('gender', '性別') ?>
                    </th>
                    <th><?= $this->Paginator->sort('company_id', '会社') ?>
                    </th>
                    <th><?= $this->Paginator->sort('prefecture_id', '都道府県') ?>
                    </th>
                    <th><?= $this->Paginator->sort('email', 'E-mail') ?>
                    </th>
                    <th class="actions"><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= h($customer->customer_cd) ?>
                    </td>
                    <td><?= h($customer->name) ?>
                    </td>
                    <td><?= match ($customer->gender){
                        1 => '男性',
                        2 => '女性',
                        default => 'その他'
                    } ?>
                    </td>
                    <td><?= $customer->has('company') ? h($customer->company->company_name) : '不明' ?>
                    </td>
                    <td><?= $customer->has('prefecture') ? h($customer->prefecture->pref_name) : '不明' ?>
                    </td>
                    <td><?= h($customer->email) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('詳細'), ['action' => 'view', $customer->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Html->link(__('更新'), ['action' => 'edit', $customer->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $customer->id], [
                            'confirm' => __('顧客 "{0}" を削除してもよろしいですか?', $customer->name),
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