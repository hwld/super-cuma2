<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Product $product
 */
?>
<div>
    <?= $this->element('/products/form', [
        'title' => '製品登録',
        'action_text' => '登録',
        'product' => $product
    ]) ?>
</div>