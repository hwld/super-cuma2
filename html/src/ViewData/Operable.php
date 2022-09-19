<?php

namespace App\ViewData;

/**
 * 操作可能なデータ
 *
 * @template T
 * */
class Operable
{
    /**
     * @param T $data
     * @param bool $canEdit
     * @param bool $canDelete
     */
    public function __construct(public $data, public $canEdit, public $canDelete)
    {
    }
}
