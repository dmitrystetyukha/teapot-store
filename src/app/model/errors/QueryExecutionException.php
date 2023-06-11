<?php

namespace app\model\errors;

use Exception;
use Throwable;

class QueryExecutionException extends Exception
{
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct('Ошибка выполнения запроса. ' . $message, $code, $previous);
    }
}