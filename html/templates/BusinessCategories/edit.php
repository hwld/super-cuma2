<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\BusinessCategory $businessCategory
 */
?>
<div>
    <?= $this->element('businessCategories/form', [
        'title' => '業種更新',
        'action_text' => '更新'
    ]) ?>
</div>