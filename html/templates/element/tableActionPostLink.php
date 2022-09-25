<?php
/**
 * @var App\View\AppView $this
 * @var mixed $url
 * @var string $type
 * @var string $text
 * @var string|null $class
 * @var string|null $confirm
 */
?>
<?php
$icon_link = match ($type) {
    'delete' => '/img/trash.svg',
    default => ''
};

$onSubmit = $confirm ? "if(!confirm('{$confirm}')){ return false; }" : '';
?>
<form class='d-inline-block <?= $class ?? '' ?>'
    method='post' action='<?= $this->Url->build($url) ?>'
    onSubmit="<?=$onSubmit?>">
    <input hidden name='_csrfToken'
        value='<?= $this->getRequest()->getAttribute('csrfToken'); ?>' />
    <button class="btn btn-sm border ms-1 fw-bold">
        <img class="align-middle" src="<?=$icon_link?>" width="15px"
            height="15px"><span class="ms-1 align-middle"><?=$text?></span>
    </button>
</form>