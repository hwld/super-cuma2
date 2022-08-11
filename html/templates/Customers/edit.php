<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 * @var string[]|\Cake\Collection\CollectionInterface $companies
 * @var string[]|\Cake\Collection\CollectionInterface $prefectures
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $customer->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Customers'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="customers form content">
            <?= $this->Form->create($customer) ?>
            <fieldset>
                <legend><?= __('Edit Customer') ?></legend>
                <?php
                    echo $this->Form->control('customer_cd');
                    echo $this->Form->control('name');
                    echo $this->Form->control('kana');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('company_id', ['options' => $companies]);
                    echo $this->Form->control('zip');
                    echo $this->Form->control('prefecture_id', ['options' => $prefectures]);
                    echo $this->Form->control('address1');
                    echo $this->Form->control('address2');
                    echo $this->Form->control('phone');
                    echo $this->Form->control('fax');
                    echo $this->Form->control('email');
                    echo $this->Form->control('lasttrade');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
