<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Prefecture $prefecture
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Prefecture'), ['action' => 'edit', $prefecture->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Prefecture'), ['action' => 'delete', $prefecture->id], ['confirm' => __('Are you sure you want to delete # {0}?', $prefecture->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Prefectures'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Prefecture'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="prefectures view content">
            <h3><?= h($prefecture->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Pref Name') ?></th>
                    <td><?= h($prefecture->pref_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($prefecture->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($prefecture->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($prefecture->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Customers') ?></h4>
                <?php if (!empty($prefecture->customers)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Customer Cd') ?></th>
                            <th><?= __('Name') ?></th>
                            <th><?= __('Kana') ?></th>
                            <th><?= __('Gender') ?></th>
                            <th><?= __('Company Id') ?></th>
                            <th><?= __('Zip') ?></th>
                            <th><?= __('Prefecture Id') ?></th>
                            <th><?= __('Address1') ?></th>
                            <th><?= __('Address2') ?></th>
                            <th><?= __('Phone') ?></th>
                            <th><?= __('Fax') ?></th>
                            <th><?= __('Email') ?></th>
                            <th><?= __('Lasttrade') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($prefecture->customers as $customers) : ?>
                        <tr>
                            <td><?= h($customers->id) ?></td>
                            <td><?= h($customers->customer_cd) ?></td>
                            <td><?= h($customers->name) ?></td>
                            <td><?= h($customers->kana) ?></td>
                            <td><?= h($customers->gender) ?></td>
                            <td><?= h($customers->company_id) ?></td>
                            <td><?= h($customers->zip) ?></td>
                            <td><?= h($customers->prefecture_id) ?></td>
                            <td><?= h($customers->address1) ?></td>
                            <td><?= h($customers->address2) ?></td>
                            <td><?= h($customers->phone) ?></td>
                            <td><?= h($customers->fax) ?></td>
                            <td><?= h($customers->email) ?></td>
                            <td><?= h($customers->lasttrade) ?></td>
                            <td><?= h($customers->created) ?></td>
                            <td><?= h($customers->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Customers', 'action' => 'view', $customers->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Customers', 'action' => 'edit', $customers->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Customers', 'action' => 'delete', $customers->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customers->id)]) ?>
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
