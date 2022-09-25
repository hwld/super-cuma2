<?php

namespace App\Controller\Component\Customers;

use Exception;

class ImporterException extends Exception
{
    public const NO_CSV_FILE = 1;
    public const COULD_NOT_SAVE = 3;
}
