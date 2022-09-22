<?php
/**
 * @var App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var App\Model\Entity\Customer $customer
 */

    $this->extend('/Common/form');

    $this->assign('title', $title);
    $this->assign('action_text', $action_text);
?>

<?php $this->start('form')?>
<?= $this->element('form/create', ['model' => $customer]) ?>
<?php $this->end()?>

<?php $this->start('form-contents')?>
<?= $this->element('form/control', [
    'field_name' => 'customer_cd',
    'field_text' => '顧客コード',
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'name',
    'field_text' => '顧客名',
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'kana',
    'field_text' => '顧客名(カナ)',
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'gender',
    'field_text' => '性別',
    'options' => [
        'type' => 'radio',
        'options' => [
            ['value' => '1', 'text' => '男性'],
            ['value' => '2' ,'text' => '女性']
        ],       
        'default' => '1'
    ]
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'company_id',
    'field_text' => '会社',
    'options' => ['type' => 'select']
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'zip',
    'field_text' => '郵便番号'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'prefecture_id',
    'field_text' => '都道府県',
    'options' => ['type' => 'select']
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'address1',
    'field_text' => '住所1'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'address2',
    'field_text' => '住所2'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'phone',
    'field_text' => '電話番号'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'fax',
    'field_text' => 'FAX'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'email',
    'field_text' => 'E-mail'
]) ?>

<div class="mt-3"></div>
<?= $this->element('form/control', [
    'field_name' => 'lasttrade',
    'field_text' => '最終取引日'
]) ?>
<?php $this->end()?>