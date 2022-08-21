<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $companies
 */
?>
<div>
    <h3><?= __('会社一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary px-3 py-1'
        ]) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
        'headers' => [
            $this->Paginator->sort('BusinessCategories.business_category_name', '業種'),
            $this->Paginator->sort('company_name', '会社名'),
            $this->Paginator->sort('company_kana', '会社名(カナ)'),
            '操作'
        ],
        'rowCells' => $companies->map(fn($company)=>[
            $company->has('business_category') ? h($company->business_category->business_category_name) : '不明',
            h($company->company_name),
            h($company->company_kana),
            $this->Html->link(__('更新'), ['action' => 'edit', $company->id], [
                'class' => 'btn btn-sm btn-secondary'
            ]).' '.
            $this->Form->postLink(__('削除'), ['action' => 'delete', $company->id], [
                'confirm' => __('会社 ${0} を削除してもよろしいですか?', $company->id),
                'class' => 'btn btn-sm btn-danger'
            ])
        ])->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>