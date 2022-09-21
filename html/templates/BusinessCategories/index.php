<?php
/**
 * @var \App\View\AppView $this
 * @var array<Operable<BusinessCategory>> $businessCategories
 * @var boolean $canAdd
 */

use App\ViewData\Operable;
use App\Model\Entity\BusinessCategory;

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
        'noDataText' => '業種が存在しません。<br>右上の追加ボタンから業種を追加してください。</br>',
        'headers' => [
            $this->Paginator->sort('business_category_name', '業種'),
            '操作'
        ],
        'rowCells' => array_map(function ($operable) {
            $businessCategory = $operable->data;
            assert($businessCategory instanceof BusinessCategory);

            $canEdit = $operable->canEdit;
            $canDelete = $operable->canDelete;

            $editButton = $canEdit ?
                $this->Html->link(__('更新'), [
                    'action' => 'edit',
                    $businessCategory->id
                ], [
                    'class' => 'btn btn-sm border'
                ])
                : null;

            $deleteButton = $canDelete ?
                $this->Form->postLink(__('削除'), [
                    'action' => 'delete', $businessCategory->id
                ], [
                    'confirm' => __('カテゴリ "{0}" を削除してもよろしいですか？', $businessCategory->business_category_name),
                    'class' => 'btn btn-sm border ms-1'
                ])
                : null;

            return [
                h($businessCategory->business_category_name),
                $editButton.$deleteButton
            ];
        }, $businessCategories)
    ])?>
    <?= $this->element('paginator') ?>
</div>