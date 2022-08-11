<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 * @var string[]|\Cake\Collection\CollectionInterface $businessCategories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $company->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $company->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Companies'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="companies form content">
            <?= $this->Form->create($company) ?>
            <fieldset>
                <legend><?= __('Edit Company') ?></legend>
                <?php
                    echo $this->Form->control('business_category_id', ['options' => $businessCategories]);
                    echo $this->Form->control('company_name');
                    echo $this->Form->control('company_kana');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
