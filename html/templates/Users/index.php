<?php
/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $users
 */
?>
<div>

    <h3><?= __('ユーザー一覧') ?>
    </h3>
    <div class="text-end">
        <?= $this->Html->link(__('追加'), ['action' => 'add'], [
            'class' => 'btn btn-primary px-3 py-1'
        ]) ?>
    </div>
    <div class="mt-2"></div>
    <?= $this->element('table',[
        'headers' => [
            $this->Paginator->sort('username', 'ユーザー名'),
            '操作'
        ],
        'rowCells' => $users->map(fn($user)=>[
            h($user->username),
            $this->Html->link(__('更新'), ['action' => 'edit', $user->id], [
                'class' => 'btn btn-sm btn-secondary'
            ]).
             $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], [
                'confirm' => __('ユーザー {0} を削除してもよろしいですか?', $user->username),
                'class' => 'btn btn-sm btn-danger ms-1'
            ])
        ])->toArray(),
    ]) ?>
    <?= $this->element('paginator') ?>
</div>