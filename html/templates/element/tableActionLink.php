<?php
/**
 * @var App\View\AppView $this
 * @var mixed $url
 * @var string $type
 * @var string $text
 * @var string|null $class
 */

$icon_link = match ($type) {
    'edit' => '/img/pen.svg',
    'view' => '/img/info.svg',
    default => '',
};
?>
<a class="btn btn-sm border fw-bold <?=$class??''?>"
    href="<?=$this->Url->build($url)?>">
    <img class="align-middle" src="<?=$icon_link?>" width="15px"
        height="15px"><span class="ms-1 align-middle"><?=$text?></span>
</a>