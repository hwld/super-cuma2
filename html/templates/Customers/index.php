<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $customers
 * @var Cake\Collection\CollectionInterface $prefectures
 * @var boolean $canAdd
 */

use App\Templator\FormTemplator;

$this->Form->setTemplates(FormTemplator::getVerticalFormTemplates());
?>
<div>
    <h3><?= __('顧客一覧') ?>
    </h3>
    <div class="card mt-3">
        <div class="card-header">
            顧客検索
        </div>
        <?= $this->Form->create(null, [
            'class' => 'card-body mb-0',
            'novalidate' => true,
            'type' => 'get',
            'valueSources' => ['query'],
        ]) ?>
        <div class="row">
            <div class="col-md-6">
                <div>
                    <?= $this->element('form/control', [
                        'field_name' => 'customer_cd',
                        'field_text' => '顧客コード'
                    ]) ?>
                </div>
                <div class="mt-2"></div>
                <?= $this->element('form/control', [
                        'field_name' => 'name',
                        'field_text' => '顧客名'
                ]) ?>
                <div class="mt-2"></div>
                <?= $this->element('form/control', [
                        'field_name' => 'kana',
                        'field_text' => '顧客名(カナ)'
                ]) ?>
                <div class="mt-2"></div>
                <?= $this->element('form/control', [
                        'field_name' => 'company_name',
                        'field_text' => '会社名',
                ]) ?>
            </div>
            <div class="col-md-6">
                <?= $this->element('form/control', [
                        'field_name' => 'pref_id',
                        'field_text' => '都道府県',
                        'options' => [
                            'type' => 'select',
                            'options' => ['' => ''] + $prefectures->toArray()
                        ]
                ]) ?>
                <div class="mt-2"></div>
                <?= $this->element('form/control', [
                        'field_name' => 'phone',
                        'field_text' => '電話番号'
                ]) ?>
                <div class="mt-2"></div>
                <?= $this->element('form/control', [
                        'field_name' => 'email',
                        'field_text' => 'メールアドレス'
                ]) ?>
                <div class="mt-2"></div>
                <div class="row">
                    <?= $this->Form->label('lasttrade_start', '最終取引日', ['class' => "col-form-label"]) ?>
                    <div class="d-flex align-items-center justify-content-stretch">
                        <div class="flex-grow-1">
                            <?= $this->Form->date('lasttrade_start', ['class' => "form-control flex-grow-1"]) ?>
                        </div>
                        <div class="mx-2">～</div>
                        <div class="flex-grow-1">
                            <?= $this->Form->date('lasttrade_end', ['class' => "form-control flex-grow-1"]) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <?= $this->Form->button('検索', [
                'class' => 'btn btn-sm btn-primary px-3',
                'name' => 'action',
                'value' => 'search'
            ]) ?>
            <?= $this->Html->link('クリア', ['action' => 'index'], ['class' => 'btn btn-sm btn-light border px-3'])?>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="text-end mt-3">
        <?php if ($canAdd): ?>
        <?= $this->Html->link(__('追加'), ['action' => 'add'], ['class' => 'btn btn-primary px-3 py-1']) ?>
        <?php endif;?>
    </div>

    <div class="mt-2"></div>
    <?= $this->element('table', [
        'headers' => [
            $this->Paginator->sort('customer_cd', '顧客コード'),
            $this->Paginator->sort('name', '名前'),
            $this->Paginator->sort('gender', '性別'),
            $this->Paginator->sort('company_id', '会社'),
            $this->Paginator->sort('prefecture_id', '都道府県'),
            $this->Paginator->sort('email', 'E-mail'),
            '操作'
        ],
        'rowCells' => $customers->map(function ($customer) {
            $customer_data = $customer['data'];
            $canEdit = $customer['permissions']['canEdit'];
            $canDelete = $customer['permissions']['canDelete'];

            $viewButton = $this->Html->link(__('詳細'), ['action' => 'view', $customer_data->id], [
                'class' => 'btn btn-sm border'
            ]);

            $updateButton = $canEdit ?
            $this->Html->link(__('更新'), ['action' => 'edit', $customer_data->id], [
                'class' => 'btn btn-sm border ms-1'
            ]) : null;

            $deleteButton = $canDelete ?
            $this->Form->postLink(__('削除'), ['action' => 'delete', $customer_data->id], [
                'confirm' => __('顧客 "{0}" を削除してもよろしいですか?', $customer_data->name),
                'class' => 'btn btn-sm border ms-1'
            ]) : null;

            return [
                h($customer_data->customer_cd),
                h($customer_data->name),
                match ($customer_data->gender) {
                    1 => '男性',
                    2 => '女性',
                    default => 'その他'
                },
                $customer_data->has('company') ? h($customer_data->company->company_name) : '不明',
                $customer_data->has('prefecture') ? h($customer_data->prefecture->pref_name) : '不明',
                h($customer_data->email),
                $viewButton.$updateButton.$deleteButton
            ];
        })->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>