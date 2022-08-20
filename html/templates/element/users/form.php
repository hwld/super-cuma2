<?php
/**
 * @var App\View\AppView $this
 * @var string $title
 * @var string $action_text
 * @var App\Model\Entity\User $user
 */

 $this->extend('/Common/form');

 $this->assign('title', $title);
 $this->assign('action_text', $action_text);
?>

<?php $this->start('form') ?>
<?= $this->element('form/create', ['model' => $user])?>
<?php $this->end()?>

<?php $this->start('form-contents') ?>
<?= $this->element('form/control',[
    'field_name' => 'username',
    'field_text' => 'ユーザー名'
])?>

<div class="mt-2"></div>
<?= $this->element('form/control', [
    'field_name' => 'password',
    'field_text' => 'パスワード'
])?>
<?php $this->end() ?>