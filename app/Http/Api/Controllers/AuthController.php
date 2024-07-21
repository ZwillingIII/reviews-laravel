<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function index(Request $request)
    {
        $request->validate([
            'phone' => 'required|min:11|max:11',
        ]);



//        $phone = preg_replace('/[^0-9]/', "", $request->input('phone'));
//        $user = DB::table('users')->where('phone', $phone)->first();

        // TODO: Сделать получение токена через модель User



//        if (!$user) {
//            $user = UserController::add($phone);
//        }

//        $user->createToken($request->input('phone'))->plainTextToken;

//        return $this->success([
//            'token' => $user->createToken($request->input('phone'))->plainTextToken,
//            'user' => $user
//        ]);
    }
}
