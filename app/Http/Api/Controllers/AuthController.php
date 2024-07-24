<?php

namespace App\Http\Api\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function register($phone, $code)
    {
        try {
            $user = User::create(['phone' => $phone]);

            $token = $user->createToken('user-' . $user['id'])->plainTextToken;
            $user->remember_token = $token;
            $user->save();

            return $this->success([
                'token' => $user,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }

    public function login($phone, $code)
    {
        $user = User::firstWhere('phone', $phone);

        $token = $user->createToken('user-' . $user['id'])->plainTextToken;
        $user->remember_token = $token;
        $user->save();

        return $this->success([
            'token' => $token,
        ]);
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|min:11|max:11',
            'code' => 'required|min:4|max:4'
        ]);

        if (!AuthCodeController::checkCode($data['phone'], $request->input('code'))) {
            return $this->fail('Неверный код', 403);
        }

        $user = User::firstWhere('phone', $data['phone']);

        if (!$user) {
            return $this->register($data['phone'], $request->get('code'));
        }

        return $this->login($data['phone'], $request->get('code'));
    }
}
