<? 
/**
 * @var App\View\AppView $this
 */
?>
<?= $this->Form->control($field_name, [
    'label' => [
        'text' => $field_text,
        'class' => 'col-form-label',
    ],
    'class' => 'form-control ' . ($this->Form->isFieldError('business_category_name') ? 'is-invalid' : ''),
]); 