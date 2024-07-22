<?php

namespace App\Http\Api\Controllers;

class AuthCodeController extends BaseController
{
    public static function getCode(string $phone) : string
    {
        $code = substr($phone, -4);

        return $code;
    }

    public static function checkCode(string $phone, string $code) : bool
    {
        return $code === self::getCode($phone);
    }
}
