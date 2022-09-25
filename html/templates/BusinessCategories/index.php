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
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
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

            $editButton = $operable->canEdit ?
                $this->element('tableActionLink', [
                    'text' => '更新',
                    'url' => ['action' => 'edit', $businessCategory->id],
                    'type' => 'edit',
                ]) : null;

            $deleteButton = $operable->canDelete ?
                $this->element('tableActionPostLink', [
                    'text' => '削除',
                    'confirm' => h("カテゴリ {$businessCategory->business_category_name} を削除してもよろしいですか？"),
                    'url' => ['action' => 'delete', $businessCategory->id],
                    'type' => 'delete',
                    'class' => 'ms-1'
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