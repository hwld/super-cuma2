<?php
/**
 * @var App\View\AppView $this
 * @var array $prefectures
 */

use App\Templator\FormTemplator;

$this->Form->setTemplates(FormTemplator::getVerticalFormTemplates());
?>
<div class="card">
    <div class="card-header">
        顧客検索
    </div>
    <?= $this->Form->create(null, [
            'url' => ['controller' => 'customers', 'action' => 'index'],
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
                            'options' => ['' => ''] + $prefectures
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
        <?= $this->Html->link('クリア', ['controller' => 'customers', 'action' => 'index'], ['class' => 'btn btn-sm btn-light border'])?>
    </div>
    <?= $this->Form->end() ?>
</div>