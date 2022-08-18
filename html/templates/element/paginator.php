<? 
/**
 * @var App\View\AppView $this
 */
?>
<ul class="pagination">
    <?= $this->Paginator->prev('< ' . __('前へ')) ?>
    <?= $this->Paginator->numbers(['first' => 1, 'last' => 1]) ?>
    <?= $this->Paginator->next(__('次へ') . ' >') ?>
</ul>