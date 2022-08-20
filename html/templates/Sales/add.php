<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Sale $sale
 * @var \Cake\Collection\CollectionInterface|string[] $customers
 * @var \Cake\Collection\CollectionInterface|string[] $products
 */
?>
<div>
    <?= $this->element('sales/form',[
        'title' => '売上登録',
        'action_text' => '登録',
        'sale' => $sale
    ]) ?>
</div>