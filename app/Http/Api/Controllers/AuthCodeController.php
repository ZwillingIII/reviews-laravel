<?php

namespace App\Http\Api\Controllers;

class AuthCodeController extends BaseController
{
    public static function getCode(string $phone) : string|bool
    {
        $code = false;

        if (!empty($phone)) {
            $code = substr($phone, -4);
        }

        return $code;
    }

    public static function checkCode(string $phone, string $code) : bool
    {
        return $code === self::getCode($phone);
    }
}
