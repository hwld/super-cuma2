<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 * @var \Cake\Collection\CollectionInterface|string[] $businessCategories
 */
?>
<div>
    <?= $this->element('/companies/form', [
        'title' => '会社登録',
        'action_text' => '登録',
        'company' => $company
    ]) ?>
</div>