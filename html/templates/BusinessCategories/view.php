<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BusinessCategory $businessCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Business Category'), ['action' => 'edit', $businessCategory->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Business Category'), ['action' => 'delete', $businessCategory->id], ['confirm' => __('Are you sure you want to delete # {0}?', $businessCategory->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Business Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Business Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="businessCategories view content">
            <h3><?= h($businessCategory->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Business Category Name') ?></th>
                    <td><?= h($businessCategory->business_category_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($businessCategory->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($businessCategory->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($businessCategory->modified) ?></td>
                </tr>
            </table>
            <div class="related">
                <h4><?= __('Related Companies') ?></h4>
                <?php if (!empty($businessCategory->companies)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Business Category Id') ?></th>
                            <th><?= __('Company Name') ?></th>
                            <th><?= __('Company Kana') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($businessCategory->companies as $companies) : ?>
                        <tr>
                            <td><?= h($companies->id) ?></td>
                            <td><?= h($companies->business_category_id) ?></td>
                            <td><?= h($companies->company_name) ?></td>
                            <td><?= h($companies->company_kana) ?></td>
                            <td><?= h($companies->created) ?></td>
                            <td><?= h($companies->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'Companies', 'action' => 'view', $companies->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'Companies', 'action' => 'edit', $companies->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Companies', 'action' => 'delete', $companies->id], ['confirm' => __('Are you sure you want to delete # {0}?', $companies->id)]) ?>
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
