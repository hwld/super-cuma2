<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BusinessCategory $businessCategory
 */
?>
<div>
    <?= $this->element('businessCategories/form', [
        'title' => '業種登録',
        'action_text' => '登録'
    ]) ?>
</div>