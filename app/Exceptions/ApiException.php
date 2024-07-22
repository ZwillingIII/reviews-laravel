<?php

namespace App\Exceptions;

use Exception;
use ReflectionClass;

class ApiException extends Exception
{
    public const PARTIAL_CONTENT = 206;
    public const TEMPORARY_REDIRECT = 307;
    public const BAD_REQUEST = 400;
    public const UNAUTHORIZED = 401;
    public const FORBIDDEN = 403;
    public const NOT_FOUND = 404;
    public const METHOD_NOT_ALLOWED = 405;
    public const VALIDATION_ERROR = 422;
    public const PROMOCODE_ERROR = 423;
    public const TOO_EARLY = 425;
    public const TOO_MANY_REQUESTS = 429;
    public const RETRY = 449;
    public const INTERNAL_ERROR = 500;
    public const SERVICE_UNAVAILABLE = 503;

    public const SMS_CLIENT_ERROR = 1001;
    public const SMS_SERVER_ERROR = 1002;
    public const SMS_CODE_INVALID = 1003;

    public const OS_CLIENT_ERROR = 1101;
    public const OS_SERVER_ERROR = 1102;

    public const SBERBANK_CLIENT_ERROR = 1201;
    public const SBERBANK_SERVER_ERROR = 1202;

    public const OV_CLIENT_ERROR = 1301;
    public const OV_SERVER_ERROR = 1302;

    public const YOUKASSA_CLIENT_ERROR = 1401;
    public const YOUKASSA_SERVER_ERROR = 1402;

    public const COUPON_ERROR = 1501;


    private int $error_code;
    private string $reason;

    public function __construct(string $reason, int $code, int $error_code, Exception $previous = null)
    {
        parent::__construct($reason, $code, $previous);
        $this->error_code = $error_code;
        $this->reason = $reason;
    }

    public static function getErrorMessage($code): int|string
    {
        $self = new ReflectionClass(__CLASS__);
        $constants = array_flip($self->getConstants());
        return $constants[$code];
    }

    public function getErrorCode(): int
    {
        return $this->error_code;
    }

    public function getReason(): string
    {
        return $this->reason;
    }
}
