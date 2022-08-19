<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Company $company
 * @var string[]|\Cake\Collection\CollectionInterface $businessCategories
 */
?>
<div>
    <?= $this->element('companies/form', [
        'title' => '会社更新',
        'action_text' => '更新',
        'company' => $company
    ]) ?>
</div>