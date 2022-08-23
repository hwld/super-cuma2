<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $businessCategories
 */
?>
<div>
    <h3><?= __('業種一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
        'headers' => [
            $this->Paginator->sort('business_category_name', '業種'),
            '操作'
        ],
        'rowCells' => $businessCategories->map(fn($businessCategory) => [
            h($businessCategory->business_category_name),
            $this->Html->link(__('更新'), [
                'action' => 'edit',
                $businessCategory->id
            ],[
                'class' => 'btn btn-sm btn-secondary'
            ]).
            $this->Form->postLink(__('削除'), [
                'action' => 'delete', $businessCategory->id
            ],[
                'confirm' => __('カテゴリ "{0}" を削除してもよろしいですか？', $businessCategory->business_category_name),
                'class' => 'btn btn-sm btn-danger ms-1'
            ],)
        ])->toArray(),
    ])?>
    <?= $this->element('paginator') ?>
</div>