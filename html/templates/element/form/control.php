<? 
/**
 * @var App\View\AppView $this
 * @var string $field_name
 * @var string $field_text
 * @var array|null $options
 */

$attr = isset($options) && is_array($options) ? $options : [];

$input_type_class = match (isset($attr['type']) ? $attr['type'] : '') {
    'select' => 'form-select',
    'radio' => 'form-check-input',
    default => 'form-control',
};

echo $this->Form->control($field_name, [
    ...$attr,
    'label' => [
        'text' => $field_text,
        'class' => 'col-form-label',
    ],
    'class' => $input_type_class.' '.
                ($this->Form->isFieldError($field_name) ? 'is-invalid' : '')
]); 
?>