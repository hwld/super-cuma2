<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Thread $thread
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Thread'), ['action' => 'edit', $thread->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Thread'), ['action' => 'delete', $thread->id], ['confirm' => __('Are you sure you want to delete # {0}?', $thread->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Threads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Thread'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="threads view content">
            <h3><?= h($thread->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($thread->id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created') ?></th>
                    <td><?= h($thread->created) ?></td>
                </tr>
                <tr>
                    <th><?= __('Modified') ?></th>
                    <td><?= h($thread->modified) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Thread Name') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($thread->thread_name)); ?>
                </blockquote>
            </div>
            <div class="related">
                <h4><?= __('Related Received Mails') ?></h4>
                <?php if (!empty($thread->received_mails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Thread Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($thread->received_mails as $receivedMails) : ?>
                        <tr>
                            <td><?= h($receivedMails->id) ?></td>
                            <td><?= h($receivedMails->title) ?></td>
                            <td><?= h($receivedMails->body) ?></td>
                            <td><?= h($receivedMails->thread_id) ?></td>
                            <td><?= h($receivedMails->created) ?></td>
                            <td><?= h($receivedMails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'ReceivedMails', 'action' => 'view', $receivedMails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'ReceivedMails', 'action' => 'edit', $receivedMails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'ReceivedMails', 'action' => 'delete', $receivedMails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $receivedMails->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php endif; ?>
            </div>
            <div class="related">
                <h4><?= __('Related Send Mails') ?></h4>
                <?php if (!empty($thread->send_mails)) : ?>
                <div class="table-responsive">
                    <table>
                        <tr>
                            <th><?= __('Id') ?></th>
                            <th><?= __('Title') ?></th>
                            <th><?= __('Body') ?></th>
                            <th><?= __('Thread Id') ?></th>
                            <th><?= __('Created') ?></th>
                            <th><?= __('Modified') ?></th>
                            <th class="actions"><?= __('Actions') ?></th>
                        </tr>
                        <?php foreach ($thread->send_mails as $sendMails) : ?>
                        <tr>
                            <td><?= h($sendMails->id) ?></td>
                            <td><?= h($sendMails->title) ?></td>
                            <td><?= h($sendMails->body) ?></td>
                            <td><?= h($sendMails->thread_id) ?></td>
                            <td><?= h($sendMails->created) ?></td>
                            <td><?= h($sendMails->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('View'), ['controller' => 'SendMails', 'action' => 'view', $sendMails->id]) ?>
                                <?= $this->Html->link(__('Edit'), ['controller' => 'SendMails', 'action' => 'edit', $sendMails->id]) ?>
                                <?= $this->Form->postLink(__('Delete'), ['controller' => 'SendMails', 'action' => 'delete', $sendMails->id], ['confirm' => __('Are you sure you want to delete # {0}?', $sendMails->id)]) ?>
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
