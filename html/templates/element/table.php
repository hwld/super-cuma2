<?php
/**
 * @var App\View\AppView $this
 * @var array $headers
 * @var array[] $rowCells
 */
?>
<div class="table-responsive">
    <table class="table table-sm table-bordered">
        <thead class="table-light">
            <?= $this->Html->tableHeaders($headers) ?>
        </thead>
        <tbody>
            <?= $this->Html->tableCells($rowCells) ?>
        </tbody>
    </table>
</div>