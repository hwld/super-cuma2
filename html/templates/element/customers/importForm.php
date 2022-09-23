<?php
/**
 * @var App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var array $import_form_context
 */

$this->extend('/Common/form');
$this->assign('title', $title);
$this->assign('action_text', $action_text);
?>

<?php $this->start('form') ?>
<?= $this->element('form/create', [
    'model' => $import_form_context,
    'options' => [
        'novalidate' => false,
        'type' => 'file',
    ]
]) ?>
<?php $this->end()?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control',[
    'field_name' => 'customers',
    'field_text' => 'CSVファイル',
    'options' => [
        'type' => 'file',
        'accept' => '.csv',
    ],
]) ?>
<?php $this->end()?>