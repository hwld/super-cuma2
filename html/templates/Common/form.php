<?php
/**
 * @var App\View\AppView $this
 */
?>
<div class="card">
    <h5 class="card-header">
        <?= $this->fetch('title') ?>
    </h5>
    <?= $this->fetch('form') ?>

    <?= $this->fetch('form-contents') ?>

    <p class="form-text mt-3 mb-0"><span style="color: red; font-size: 1.25rem;">*</span>のついている項目は入力が必須です。</p>
    <div class="mt-1">
        <?= $this->Form->button(__($this->fetch('action_text')), ['class' => 'btn btn-sm btn-primary px-3']) ?>
        <?= $this->Html->link('戻る', ['action' => 'index'], [
                    'class' => 'btn btn-sm px-3 btn-light border'
        ]) ?>
    </div>
    <?= $this->Form->end() ?>
</div>