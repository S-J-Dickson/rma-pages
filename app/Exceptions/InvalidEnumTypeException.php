<?php

namespace App\Exceptions;

use Exception;
use Throwable;

class InvalidEnumTypeException extends Exception {
    public function __construct($message = "Type does not exist, please add enum type and classes.", $code = 0, Throwable $previous = null) {
        parent::__construct($message, $code, $previous);
    }
}

