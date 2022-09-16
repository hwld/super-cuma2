<?php
/**
 * @var App\View\AppView $this
 * @var array $headers
 * @var array[] $rowCells
 */
?>
<?php $this->start('css'); ?>
<style>
    .table-card>.table {
        background-color: white;
        white-space: nowrap;
    }

    /* テーブルのヘッダーの下線を他の行の色と同じにする */
    .table-card>.table>thead>tr>th {
        border-bottom-color: inherit !important;
    }

    /*　最後の行の下のborderを消す */
    .table-card>.table>tbody>tr:last-child>td {
        border-width: 0;
    }

    .table-card>.table td {
        vertical-align: middle;
    }
</style>
<?php $this->end();?>
<div class="table-responsive card table-card mb-3">
    <table class="table mb-0">
        <thead class="bg-light">
            <?= $this->Html->tableHeaders($headers) ?>
        </thead>
        <tbody>
            <?= $this->Html->tableCells($rowCells) ?>
        </tbody>
    </table>
</div>