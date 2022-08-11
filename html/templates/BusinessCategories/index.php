<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BusinessCategory[]|\Cake\Collection\CollectionInterface $businessCategories
 */
?>
<div class="businessCategories index content">
    <?= $this->Html->link(__('New Business Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Business Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?></th>
                    <th><?= $this->Paginator->sort('business_category_name') ?></th>
                    <th><?= $this->Paginator->sort('created') ?></th>
                    <th><?= $this->Paginator->sort('modified') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($businessCategories as $businessCategory): ?>
                <tr>
                    <td><?= $this->Number->format($businessCategory->id) ?></td>
                    <td><?= h($businessCategory->business_category_name) ?></td>
                    <td><?= h($businessCategory->created) ?></td>
                    <td><?= h($businessCategory->modified) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $businessCategory->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $businessCategory->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $businessCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $businessCategory->id)]) ?>
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
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>
