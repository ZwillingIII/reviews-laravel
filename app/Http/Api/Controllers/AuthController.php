<?php

namespace App\Http\Api\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    // TODO: переписать под модель User
    public function register($phone, $code)
    {
        try {

            $user = User::create(['phone' => $phone]);


            if (!AuthCodeController::checkCode($phone, $code)) {
                return $this->fail('Неверный код', 403);
            }

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
        if (!AuthCodeController::checkCode($phone, $code)) {
            return $this->fail('Неверный код', 403);
        }

        $user = User::firstWhere('phone', $phone);

        if (empty($user['remember_token'])) {
            $token = $user->createToken('user-' . $user['id'])->plainTextToken;
            $user->remember_token = $token;
            $user->save();
        }

        return $this->success([
            'status' => 200,
            'user' => Auth::user(),
            'token' => User::firstWhere('phone', $phone)['remember_token'],
        ]);
    }

    public function auth(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|min:11|max:11',
            'code' => 'required|min:4|max:4'
        ]);

        $user = User::firstWhere('phone', $data['phone']);

        if (!$user) {
            return $this->register($data['phone'], $request->get('code'));
        }

        return $this->login($data['phone'], $request->get('code'));
    }
}
