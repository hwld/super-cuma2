<?php
/**
 * @var \App\View\AppView $this
 * @var array<Operable<Company>> $companies
 * @var boolean $canAdd
 */

use App\ViewData\Operable;
use App\Model\Entity\Company;

?>
<div>
    <h3><?= __('会社一覧') ?>
    </h3>
    <div class="text-end">
        <?php if ($canAdd): ?>
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary'
        ]) ?>
        <?php endif; ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table', [
        'noDataText' => '会社が存在しません。<br>右上の追加ボタンから会社を追加してください。</br>',
        'headers' => [
            $this->Paginator->sort('BusinessCategories.business_category_name', '業種'),
            $this->Paginator->sort('company_name', '会社名'),
            $this->Paginator->sort('company_kana', '会社名(カナ)'),
            '操作'
        ],
        'rowCells' => array_map(function (Operable $operable) {
            $company = $operable->data;
            assert($company instanceof Company);

            $editBUtton = $operable->canEdit ?
                $this->element('tableActionLink', [
                    'text' => '更新',
                    'url' => ['action' => 'edit', $company->id],
                    'type' => 'edit'
                ]) : null;

            $deleteButton = $operable->canDelete ?
                $this->element('tableActionPostLink', [
                    'text' => '削除',
                    'confirm' => "会社 {$company->company_name} を削除してもよろしいですか？",
                    'url' => ['action' => 'delete', $company->id],
                    'type' => 'delete',
                    'class' => 'ms-1'
                ]) : null;

            return [
                $company->has('business_category') ? h($company->business_category->business_category_name) : '不明',
                h($company->company_name),
                h($company->company_kana),
                $editBUtton.$deleteButton
            ];
        }, $companies)
    ]) ?>
    <?= $this->element('paginator') ?>
</div>