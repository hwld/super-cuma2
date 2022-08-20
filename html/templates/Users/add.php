<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div>
    <?= $this->element('/users/form',[
        'title' => 'ユーザー登録',
        'action_text' => '登録',
        'user' => $user
    ])?>
</div>