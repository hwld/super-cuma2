<?php
/**
 * @var App\View\AppView $this
 * @var mixed $model
 * @var array|null $options
 * @var bool|null $novalidate
 * @var string|null $type
 */

 $default_options = [
    'class' => 'card-body',
    'novalidate' => true,
 ];
 $input_options = (isset($options) && is_array($options)) ? $options : [];
?>
<?= $this->Form->create($model, [
    ...$default_options,
    ...$input_options,
]) ?>