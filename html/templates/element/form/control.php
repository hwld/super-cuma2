<? 
/**
 * @var App\View\AppView $this
 * @var string $field_name
 * @var string $field_text
 * @var string $is_select
 */
?>
<?= $this->Form->control($field_name, [
    'label' => [
        'text' => $field_text,
        'class' => 'col-form-label',
    ],
    'class' => (isset($is_select) ? 'form-select ' : 'form-control ').
                ($this->Form->isFieldError($field_name) ? 'is-invalid ' : ' ')
]); 