<?php
/**
 * @var App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var mixed $company
 */
 $this->extend('/Common/form');

 $this->assign('title', $title);
 $this->assign('action_text', $action_text)
?>

<?php $this->start('form') ?>
<?= $this->element('form/create', ['model' => $company]) ?>
<?php $this->end()?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control', [
        'field_name' => 'business_category_id',
        'field_text' => '業種',
        'options' => ['type' => 'select']
])?>
<div class="mt-2"></div>
<?= $this->element('form/control', [
        'field_name' => 'company_name',
        'field_text' => '会社名'
])?>
<div class="mt-2"></div>
<?= $this->element('form/control', [
        'field_name' => 'company_kana',
        'field_text' => '会社名(カナ)'
])?>
<?php $this->end() ?>