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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $businessCategory->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $businessCategory->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Business Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="businessCategories form content">
            <?= $this->Form->create($businessCategory) ?>
            <fieldset>
                <legend><?= __('Edit Business Category') ?></legend>
                <?php
                    echo $this->Form->control('business_category_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
