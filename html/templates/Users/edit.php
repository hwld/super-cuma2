<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<div>
    <?= $this->element('users/form',[
        'title' => 'ユーザー更新',
        'action_text' => '更新',
        'user' => $user
    ])?>
</div>