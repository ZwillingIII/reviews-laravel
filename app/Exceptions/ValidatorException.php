<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\MessageBag;

class ValidatorException extends ApiException
{
    private MessageBag $errors;

    public function __construct(string $reason, int $code, int $error_code, Exception $previous = null, MessageBag $errors)
    {
        parent::__construct($reason, $code, $error_code, $previous);
        $this->errors = $errors;

    }

    public function getErrors(): array
    {
        $processed = [];
        foreach ($this->errors->toArray() as $key => $value) {
            $processed += [$key => $value[0]];
        }

        return ['errors' => $processed];

    }

}
