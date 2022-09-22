<?php
/**
 * @var App\View\AppView $this
 * @var Cake\Collection\CollectionInterface $customers
 * @var array<Operable<Customer>> $customers
 * @var Cake\Collection\CollectionInterface $prefectures
 * @var boolean $canAdd
 * @var boolean $searched
 * @var string $csrfToken
 */

use App\Model\Entity\Customer;
use App\ViewData\Operable;
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
                'class' => 'btn btn-sm btn-primary',
                'name' => 'action',
                'value' => 'search'
            ]) ?>
            <?= $this->Html->link('クリア', ['action' => 'index'], ['class' => 'btn btn-sm btn-light border'])?>
        </div>
        <?= $this->Form->end() ?>
    </div>

    <div class="mt-3 d-flex justify-content-between">
        <?php if ($canAdd): ?>
        <div>
            <?= $this->Html->link(__('インポート'), ['action' => 'import'], ['class' => 'btn border bg-white']) ?>
            <?= $this->Html->link(__('ダウンロード'), ['action' => 'export'], ['class' => 'btn border bg-white']) ?>
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
        'rowCells' => array_map(function ($operable) use ($csrfToken) {
            $customer = $operable->data;
            // vscode-intelephenseがtemplateをサポートしていないのでmixideになってしまう。
            // https://github.com/bmewburn/vscode-intelephense/issues/1144
            assert($customer instanceof Customer);

            $canEdit = $operable->canEdit;
            $canDelete = $operable->canDelete;

            $viewButton =
            '<a class="btn btn-sm border fw-bold" href="/customers/view/'.$customer->id.'">'.
                '<img class="align-middle" src="/img/info.svg" width="15px" height="15px" />'.
                '<span class="ms-1 align-middle">詳細</span>'.
            '</a>';

            $updateButton = $canEdit ?
            $this->Html->link(__('更新'), ['action' => 'edit', $customer->id], [
                'class' => 'btn btn-sm border ms-1'
            ]) : null;

            $updateButton = $canEdit ?
            "<a class='ms-1 btn btn-sm border fw-bold' href='/customers/edit/{$customer->id}''>".
                '<img class="align-middle" src="/img/pen.svg" width="15px" height="15px" />'.
                '<span class="ms-1 align-middle">更新</span>'.
            '</a>' : null;

            $onSubmit = "if(!confirm(\"顧客{$customer->name}を削除してもよろしいですか?\")) { return false; }";
            $deleteButton = $canDelete ?
            "<form class='d-inline-block' method='post' action='/customers/delete/{$customer->id}' onSubmit='{$onSubmit}' >".
                "<input hidden name='_csrfToken' value='{$csrfToken}' />".
                '<button class="btn btn-sm border ms-1 fw-bold">'.
                    '<img class="align-middle" src="/img/trash.svg" width="15px" height="15px" />'.
                    '<span class="ms-1 align-middle">削除</span>'.
                '</button>'.
            '</form>'
            : null;

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