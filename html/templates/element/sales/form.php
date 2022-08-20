<?php
/**
 * @var App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var App\Model\Entity\Sale $sale
 */

    $this->extend('/Common/form');

    $this->assign('title', $title);
    $this->assign('action_text', $action_text);
?>

<?php $this->start('form') ?>
<?= $this->element('/form/create', ['model' => $sale]); ?>
<?php $this->end() ?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control', [
    'field_name' => 'purchase_date',
    'field_text' => '購入日'
]) ?>

<div class="mt-2"></div>
<?= $this->element('form/control', [
    'field_name' => 'customer_id',
    'field_text' => '顧客',
    'options' => ['type' => 'select']
]) ?>

<div class="mt-2"></div>
<?= $this->element('form/control', [
    'field_name' => 'product_id',
    'field_text' => '製品',
    'options' => ['type' => 'select']
]) ?>

<div class="mt-2"></div>
<?= $this->element('form/control', [
    'field_name' => 'amount',
    'field_text' => '個数'
]) ?>
<?php $this->end()?>