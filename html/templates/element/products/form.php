<?php
/**
 * @var App\View\AppView $this
 * @var mixed $product
 * @var string $title
 * @var string $action_text
 */

    $this->extend('/Common/form');

    $this->assign('title', $title);
    $this->assign('action_text', $action_text);
?>

<?php $this->start('form') ?>
<?= $this->element('form/create', ['model' => $product]) ?>
<?php $this->end()?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control', [
    'field_name' => 'product_name',
    'field_text' => '製品名'
]) ?>
<div class="mt-2"></div>
<?= $this->element('form/control', [
    'field_name' => 'unit_price',
    'field_text' => '単価'
]) ?>
<?php $this->end()?>