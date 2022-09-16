<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $users
 */
?>
<div>

    <h3><?= __('ユーザー一覧') ?>
    </h3>
    <div class="mt-4"></div>
    <?= $this->element('table', [
        'headers' => [
            $this->Paginator->sort('username', 'ユーザー名'),
            $this->Paginator->sort('email', 'メールアドレス'),
            '操作'
        ],
        'rowCells' => $users->map(function ($user) {
            $user_data = $user['data'];
            $canEdit = $user['permissions']['canEdit'];
            $canDelete = $user['permissions']['canDelete'];

            $editButton =  $canEdit ?
                $this->Html->link(__('更新'), ['action' => 'edit', $user_data->id], [
                    'class' => 'btn btn-sm border'
                ]) : null;

            $deleteButton = $canDelete ?
                $this->Form->postLink(__('削除'), ['action' => 'delete', $user_data->id], [
                    'confirm' => __('ユーザー {0} を削除してもよろしいですか?', $user_data->username),
                    'class' => 'btn btn-sm border ms-1'
                ]) : null;

            return [
                h($user_data->username),
                h($user_data->email),
                $editButton . $deleteButton
            ];
        })->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>