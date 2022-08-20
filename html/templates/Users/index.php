<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
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
    <div class="table-responsive mt-2">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('username', 'ユーザー名') ?>
                    </th>
                    <th class="actions"><?= __('操作') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                <tr>
                    <td><?= h($user->username) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('更新'), ['action' => 'edit', $user->id], [
                            'class' => 'btn btn-sm btn-secondary'
                        ]) ?>
                        <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], [
                            'confirm' => __('ユーザー {0} を削除してもよろしいですか?', $user->username),
                            'class' => 'btn btn-sm btn-danger'
                        ]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?= $this->element('paginator') ?>
</div>