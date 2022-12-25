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
            <?= $this->Html->link(__('List Threads'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="threads form content">
            <?= $this->Form->create($thread) ?>
            <fieldset>
                <legend><?= __('Add Thread') ?></legend>
                <?php
                    echo $this->Form->control('thread_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
