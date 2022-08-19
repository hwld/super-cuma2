<?php
/**
 * @var \App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var App\Model\Entity\BusinessCategory $businessCategory
 */

 $this->extend('/Common/form');
 
 $this->assign('title', $title);
 $this->assign('action_text', $action_text)
?>

<?php $this->start('form') ?>
<?= $this->element('form/create', ['model' => $businessCategory]) ?>
<?php $this->end()?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control', [
                'field_name' => 'business_category_name',
                'field_text' => '業種'
]) ?>
<?php $this->end()?>