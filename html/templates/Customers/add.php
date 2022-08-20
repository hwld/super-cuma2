<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Customer $customer
 * @var \Cake\Collection\CollectionInterface|string[] $companies
 * @var \Cake\Collection\CollectionInterface|string[] $prefectures
 */
?>
<div>
    <?= $this->element('/customers/form', [
        'title' => '顧客登録',
        'action_text' => '登録',
        'customer' => $customer
    ]) ?>
    <div style="height: 100px;"></div>
</div>