<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer[]|\Cake\Collection\CollectionInterface $customers
 */
?>
<div class="customers index content">
    <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Customers') ?>
    </h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('id') ?>
                    </th>
                    <th><?= $this->Paginator->sort('customer_cd') ?>
                    </th>
                    <th><?= $this->Paginator->sort('name') ?>
                    </th>
                    <th><?= $this->Paginator->sort('kana') ?>
                    </th>
                    <th><?= $this->Paginator->sort('gender') ?>
                    </th>
                    <th><?= $this->Paginator->sort('company_id') ?>
                    </th>
                    <th><?= $this->Paginator->sort('zip') ?>
                    </th>
                    <th><?= $this->Paginator->sort('prefecture_id') ?>
                    </th>
                    <th><?= $this->Paginator->sort('address1') ?>
                    </th>
                    <th><?= $this->Paginator->sort('address2') ?>
                    </th>
                    <th><?= $this->Paginator->sort('phone') ?>
                    </th>
                    <th><?= $this->Paginator->sort('fax') ?>
                    </th>
                    <th><?= $this->Paginator->sort('email') ?>
                    </th>
                    <th><?= $this->Paginator->sort('lasttrade') ?>
                    </th>
                    <th><?= $this->Paginator->sort('created') ?>
                    </th>
                    <th><?= $this->Paginator->sort('modified') ?>
                    </th>
                    <th class="actions"><?= __('Actions') ?>
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $customer): ?>
                <tr>
                    <td><?= $this->Number->format($customer->id) ?>
                    </td>
                    <td><?= h($customer->customer_cd) ?>
                    </td>
                    <td><?= h($customer->name) ?>
                    </td>
                    <td><?= h($customer->kana) ?>
                    </td>
                    <td><?= $this->Number->format($customer->gender) ?>
                    </td>
                    <td><?= $customer->has('company') ? $this->Html->link($customer->company->id, ['controller' => 'Companies', 'action' => 'view', $customer->company->id]) : '' ?>
                    </td>
                    <td><?= h($customer->zip) ?>
                    </td>
                    <td><?= $customer->has('prefecture') ? $this->Html->link($customer->prefecture->id, ['controller' => 'Prefectures', 'action' => 'view', $customer->prefecture->id]) : '' ?>
                    </td>
                    <td><?= h($customer->address1) ?>
                    </td>
                    <td><?= h($customer->address2) ?>
                    </td>
                    <td><?= h($customer->phone) ?>
                    </td>
                    <td><?= h($customer->fax) ?>
                    </td>
                    <td><?= h($customer->email) ?>
                    </td>
                    <td><?= h($customer->lasttrade) ?>
                    </td>
                    <td><?= h($customer->created) ?>
                    </td>
                    <td><?= h($customer->modified) ?>
                    </td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $customer->id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $customer->id]) ?>
                        <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?>
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