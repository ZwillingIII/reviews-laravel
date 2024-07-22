<?php

namespace App\Http\Api\Controllers;

use App\Http\Api\Helpers\Dto\UserDto;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public static function add(UserDto $user)
    {
        try {
            $add = DB::table('users')->insert([
                'phone' => $user->phone,
                'remember_token' => $user->token,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            return (new BaseController())->success([
                'result' => $add,
                'data' => DB::table('users')->where('phone', $user->phone)->first()
            ]);
        } catch (\Exception $e) {
            return (new BaseController())->fail($e->getMessage());
        }
    }

    public function getById(int $id)
    {

    }
}
