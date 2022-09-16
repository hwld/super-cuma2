<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $companies
 * @var boolean $canAdd
 */
?>
<div>
    <h3><?= __('会社一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary px-3 py-1'
        ]) ?>
        <?php endif; ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
        'headers' => [
            $this->Paginator->sort('BusinessCategories.business_category_name', '業種'),
            $this->Paginator->sort('company_name', '会社名'),
            $this->Paginator->sort('company_kana', '会社名(カナ)'),
            '操作'
        ],
        'rowCells' => $companies->map(function ($company) {
            $company_data = $company['data'];
            $canEdit = $company['permissions']['canEdit'];
            $canDelete = $company['permissions']['canDelete'];

            $editBUtton = $canEdit ?
                $this->Html->link(__('更新'), ['action' => 'edit', $company_data->id], [
                    'class' => 'btn btn-sm btn-secondary'
                ]) : null;

            $deleteButton = $canDelete ?
                $this->Form->postLink(__('削除'), ['action' => 'delete', $company_data->id], [
                    'confirm' => __('会社 ${0} を削除してもよろしいですか?', $company_data->id),
                    'class' => 'btn btn-sm btn-danger ms-1'
                ]) : null;

            return [
                $company_data->has('business_category') ? h($company_data->business_category->business_category_name) : '不明',
                h($company_data->company_name),
                h($company_data->company_kana),
                $editBUtton.$deleteButton
            ];
        })->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>