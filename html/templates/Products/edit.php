<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div>
    <?= $this->element('products/form',[
        'title' => '製品更新',
        'action_text' => '更新',
        'product' => $product
    ]) ?>
</div>