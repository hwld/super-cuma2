<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 * @var string[]|\Cake\Collection\CollectionInterface $customers
 * @var string[]|\Cake\Collection\CollectionInterface $products
 */
?>
<div>
    <?= $this->element('sales/form',[
        'title' => '売上更新',
        'action_text' => '更新',
        'sale' => $sale
    ]) ?>
</div>