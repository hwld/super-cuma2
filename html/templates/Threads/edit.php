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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $thread->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $thread->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Threads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="threads form content">
            <?= $this->Form->create($thread) ?>
            <fieldset>
                <legend><?= __('Edit Thread') ?></legend>
                <?php
                    echo $this->Form->control('thread_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
