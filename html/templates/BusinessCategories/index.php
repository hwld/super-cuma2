<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $businessCategories
 * @var boolean $canAdd
 */
?>
<div>
    <h3><?= __('業種一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
        <?php endif;?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
        'headers' => [
            $this->Paginator->sort('business_category_name', '業種'),
            '操作'
        ],
        'rowCells' => $businessCategories->map(function ($businessCategory) {
            $businessCategory_data = $businessCategory['data'];
            $canEdit = $businessCategory['permissions']['canEdit'];
            $canDelete = $businessCategory['permissions']['canDelete'];

            $editButton = $canEdit ?
                $this->Html->link(__('更新'), [
                    'action' => 'edit',
                    $businessCategory_data->id
                ], [
                    'class' => 'btn btn-sm border'
                ])
                : null;

            $deleteButton = $canDelete ?
                $this->Form->postLink(__('削除'), [
                    'action' => 'delete', $businessCategory_data->id
                ], [
                    'confirm' => __('カテゴリ "{0}" を削除してもよろしいですか？', $businessCategory_data->business_category_name),
                    'class' => 'btn btn-sm border ms-1'
                ])
                : null;

            return [
                h($businessCategory_data->business_category_name),
                $editButton.$deleteButton
            ];
        })->toArray(),
    ])?>
    <?= $this->element('paginator') ?>
</div>