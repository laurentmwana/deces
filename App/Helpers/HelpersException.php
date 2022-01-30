<?php

namespace App\Helpers;

use Exception;
use Throwable;

class HelpersException extends Exception {

    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code , $previous);
    }
}