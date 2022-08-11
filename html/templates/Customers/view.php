<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Customers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Customer'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customers view content">
            <h3><?= h($customer->name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Customer Cd') ?></th>
                    <td><?= h($customer->customer_cd) ?></td>
                </tr>
                <tr>
                    <th><?= __('Name') ?></th>
                    <td><?= h($customer->name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Kana') ?></th>
                    <td><?= h($customer->kana) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company') ?></th>
                    <td><?= $customer->has('company') ? $this->Html->link($customer->company->id, ['controller' => 'Companies', 'action' => 'view', $customer->company->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Zip') ?></th>
                    <td><?= h($customer->zip) ?></td>
                </tr>
                <tr>
                    <th><?= __('Prefecture') ?></th>
                    <td><?= $customer->has('prefecture') ? $this->Html->link($customer->prefecture->id, ['controller' => 'Prefectures', 'action' => 'view', $customer->prefecture->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Address1') ?></th>
                    <td><?= h($customer->address1) ?></td>
                </tr>
                <tr>
                    <th><?= __('Address2') ?></th>
                    <td><?= h($customer->address2) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone') ?></th>
                    <td><?= h($customer->phone) ?></td>
                </tr>
                <tr>
                    <th><?= __('Fax') ?></th>
                    <td><?= h($customer->fax) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($customer->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($customer->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Gender') ?></th>
                    <td><?= $this->Number->format($customer->gender) ?></td>
                </tr>
                <tr>
                    <th><?= __('Lasttrade') ?></th>
                    <td><?= h($customer->lasttrade) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($customer->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($customer->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Sales') ?></h4>
                <?php if (!empty($customer->sales)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Purchase Date') ?></th>
                            <th><?= __('Customer Id') ?></th>
                            <th><?= __('Product Id') ?></th>
                            <th><?= __('Amount') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($customer->sales as $sales) : ?>
                        <tr>
                            <td><?= h($sales->id) ?></td>
                            <td><?= h($sales->purchase_date) ?></td>
                            <td><?= h($sales->customer_id) ?></td>
                            <td><?= h($sales->product_id) ?></td>
                            <td><?= h($sales->amount) ?></td>
                            <td><?= h($sales->created) ?></td>
                            <td><?= h($sales->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Sales', 'action' => 'view', $sales->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Sales', 'action' => 'edit', $sales->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Sales', 'action' => 'delete', $sales->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sales->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
