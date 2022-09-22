<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $users
 */

use App\Model\Entity\User;

?>
<div>

    <h3><?= __('ユーザー一覧') ?>
    </h3>
    <div class="mt-4"></div>
    <?= $this->element('table', [
        'noDataText' => 'ユーザーが存在しません。',
        'headers' => [
            $this->Paginator->sort('username', 'ユーザー名'),
            $this->Paginator->sort('email', 'メールアドレス'),
            '操作'
        ],
        'rowCells' => $users->map(function ($user) {
            $user_data = $user['data'];
            assert($user_data instanceof User);
            $canEdit = $user['permissions']['canEdit'];
            $canDelete = $user['permissions']['canDelete'];

            $updateButton = $canEdit ?
                $this->element('tableActionLink', [
                    'text' => '更新',
                    'url' => ['action' => 'edit', $user_data->id],
                    'type' => 'edit',
                    'class' => 'ms-1'
                ]) : null;

            $deleteButton = $canDelete ?
                $this->element('tableActionPostLink', [
                    'text' => '削除',
                    'confirm' => "顧客 \"{$user_data->username}\" を削除してもよろしいですか？",
                    'url' => ['action' => 'delete', $user_data->id],
                    'type' => 'delete',
                    'class' => 'ms-1',
                ]) : null;

            return [
                h($user_data->username),
                h($user_data->email),
                $updateButton . $deleteButton
            ];
        })->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>