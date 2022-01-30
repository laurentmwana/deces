<?php

namespace App\Routes;

use Exception;
use Throwable;

class RouterException extends Exception {

    public function __construct(string $message = "", int $code = 1, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}