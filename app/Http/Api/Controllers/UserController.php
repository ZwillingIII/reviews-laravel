<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function add(string $phone)
    {
        try {
            $add = DB::table('users')->insert([
                'phone' => $phone,
            ]);

            return (new BaseController())->success([
                'result' => $add,
                'data' => DB::table('users')->where('phone', $phone)->first()
            ]);
        } catch (\Exception $e) {
            return (new BaseController())->fail($e->getMessage());
        }
    }
}
