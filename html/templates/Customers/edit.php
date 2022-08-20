<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 * @var string[]|\Cake\Collection\CollectionInterface $companies
 * @var string[]|\Cake\Collection\CollectionInterface $prefectures
 */
?>
<div>
    <?= $this->element('/customers/form',[
        'title' => '顧客更新',
        'action_text' => '更新',
        'customer' => $customer
    ])?>
</div>