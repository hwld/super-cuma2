<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $customers
 */
?>
<div>
    <h3><?= __('顧客一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
        'headers' => [
            $this->Paginator->sort('customer_cd', '顧客コード'),
            $this->Paginator->sort('name', '名前'),
            $this->Paginator->sort('gender', '性別'),
            $this->Paginator->sort('company_id', '会社'),
            $this->Paginator->sort('prefecture_id', '都道府県'),
            $this->Paginator->sort('email', 'E-mail'),
            '操作'
        ],
        'rowCells' => $customers->map(fn($customer) => [
            h($customer->customer_cd),
            h($customer->name),
            match ($customer->gender){
                1 => '男性',
                2 => '女性',
                default => 'その他'
            },
            $customer->has('company') ? h($customer->company->company_name) : '不明',
            $customer->has('prefecture') ? h($customer->prefecture->pref_name) : '不明',
            h($customer->email),
            $this->Html->link(__('詳細'), ['action' => 'view', $customer->id], [
                'class' => 'btn btn-sm btn-secondary'
            ]).' '.
            $this->Html->link(__('更新'), ['action' => 'edit', $customer->id], [
                'class' => 'btn btn-sm btn-secondary'
            ]).' '.
            $this->Form->postLink(__('削除'), ['action' => 'delete', $customer->id], [
                'confirm' => __('顧客 "{0}" を削除してもよろしいですか?', $customer->name),
                'class' => 'btn btn-sm btn-danger'
            ])
        ])->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>