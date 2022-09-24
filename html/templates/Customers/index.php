<?php
/**
 * @var App\View\AppView $this
 * @var Cake\Collection\CollectionInterface $customers
 * @var array<Operable<Customer>> $customers
 * @var Cake\Collection\CollectionInterface $prefectures
 * @var boolean $canAdd
 * @var boolean $searched
 */

use App\Model\Entity\Customer;
use App\ViewData\Operable;
use App\Templator\FormTemplator;

?>
<div>
    <h3><?= __('顧客一覧') ?>
    </h3>
    <div class="mt-3"></div>
    <?= $this->element('/customers/searchForm', [
        'prefectures' => $prefectures->toArray()
    ]) ?>
    <div class="mt-3 d-flex justify-content-between">
        <?php if ($canAdd): ?>
        <div>
            <?= $this->Html->link(__('インポート'), ['action' => 'import'], ['class' => 'btn border bg-white']) ?>
            <?= $this->Form->postLink(__('ダウンロード'), ['action' => 'export'], ['class' => 'btn border bg-white']) ?>
        </div>
        <div>
            <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary']) ?>
        </div>
        <?php endif;?>
    </div>

    <div class="mt-2"></div>
    <?= $this->element('table', [
        'noDataText' => $searched
            ? '検索条件に一致する顧客はいません。<br>別の条件をお試しください。</br>'
            : '顧客がまだ登録されていません。<br>右上の追加ボタンから顧客を追加してください。</br>',
        'headers' => [
            $this->Paginator->sort('customer_cd', '顧客コード'),
            $this->Paginator->sort('name', '名前'),
            $this->Paginator->sort('gender', '性別'),
            $this->Paginator->sort('company_id', '会社'),
            $this->Paginator->sort('prefecture_id', '都道府県'),
            $this->Paginator->sort('email', 'E-mail'),
            '操作'
        ],
        'rowCells' => array_map(function ($operable) {
            $customer = $operable->data;
            // vscode-intelephenseがtemplateをサポートしていないのでmixideになってしまう。
            // https://github.com/bmewburn/vscode-intelephense/issues/1144
            assert($customer instanceof Customer);

            $viewButton = $this->element('tableActionLink', [
                'text' => '詳細',
                'url' => ['action' => 'view', $customer->id],
                'type' => "view",
            ]);

            $updateButton = $operable->canEdit ?
                $this->element('tableActionLink', [
                    'text' => '更新',
                    'url' => ['action' => 'edit', $customer->id],
                    'type' => 'edit',
                    'class' => 'ms-1'
                ]) : null;

            $deleteButton = $operable->canDelete ?
                $this->element('tableActionPostLink', [
                    'text' => '削除',
                    'confirm' => "顧客 \"{$customer->name}\" を削除してもよろしいですか？",
                    'url' => ['action' => 'delete', $customer->id],
                    'type' => 'delete',
                    'class' => 'ms-1',
                ]) : null;

            return [
                h($customer->customer_cd),
                h($customer->name),
                match ($customer->gender) {
                    1 => '男性',
                    2 => '女性',
                    default => 'その他'
                },
                $customer->has('company') ? h($customer->company->company_name) : '不明',
                $customer->has('prefecture') ? h($customer->prefecture->pref_name) : '不明',
                h($customer->email),
                $viewButton.$updateButton.$deleteButton
            ];
        }, $customers)
    ]) ?>
    <?= $this->element('paginator') ?>
</div>