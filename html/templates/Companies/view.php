<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Company'), ['action' => 'edit', $company->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Company'), ['action' => 'delete', $company->id], ['confirm' => __('Are you sure you want to delete # {0}?', $company->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Companies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Company'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="companies view content">
            <h3><?= h($company->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Business Category') ?></th>
                    <td><?= $company->has('business_category') ? $this->Html->link($company->business_category->id, ['controller' => 'BusinessCategories', 'action' => 'view', $company->business_category->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Name') ?></th>
                    <td><?= h($company->company_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Company Kana') ?></th>
                    <td><?= h($company->company_kana) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($company->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($company->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($company->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Customers') ?></h4>
                <?php if (!empty($company->customers)) : ?>
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
                        <?php foreach ($company->customers as $customers) : ?>
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
