<?php
/**
 * @var App\View\AppView $this
 */
?>
<?php if ($this->Paginator->total() > 1): ?>
<ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('前へ')) ?>
    <?= $this->Paginator->numbers(['first' => 1, 'last' => 1]) ?>
    <?= $this->Paginator->next(__('次へ') . ' >') ?>
</ul>
<?php endif;
