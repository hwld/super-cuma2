<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Thread[]|\Cake\Collection\CollectionInterface $threads
 */
?>
<div class="threads index content">
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?>
                    </th>
                    <th><?= $this->Paginator->sort('created') ?>
                    </th>
                    <th><?= $this->Paginator->sort('modified') ?>
                    </th>
                    <th class="actions">
                        <?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($threads as $thread): ?>
                <tr>
                    <td><?= $this->Number->format($thread->id) ?>
                    </td>
                    <td><?= h($thread->created) ?></td>
                    <td><?= h($thread->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $thread->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $thread->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $thread->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thread->id)]) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?>
        </p>
    </div>
</div>