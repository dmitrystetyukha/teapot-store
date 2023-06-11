<?php

namespace app\model\errors;

use Exception;
use Throwable;

class TeapotNotExistException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        $message = 'Чайник не найден в базе. ' . $message;
        parent::__construct($message, $code, $previous);
    }
}