<?php
/**
 * @var App\View\AppView $this
 * @var array $import_form_context
 */
?>
<?= $this->element('customers/importForm',[
    'title' => 'インポート',
    'action_text' => 'インポートする',
    'import_form_context' => $import_form_context,
]) ?>