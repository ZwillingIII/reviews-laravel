<?php

namespace App\Http\Api\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AuthController extends BaseController
{
    public function auth(Request $request)
    {
        $data = $request->validate([
            'phone' => 'required|min:11|max:11',
        ]);

        $user = User::where('phone', $data['phone'])->first();

        if (!$user) {
            try {
                DB::table('users')->insert([
                    'phone' => $data['phone'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $user = User::where('phone', $data['phone'])->first();

                $token = $user->createToken('user-' . $user['id'])->plainTextToken;
                DB::table('users')->where('phone', $data['phone'])->update(['remember_token' => $token]);

                return $this->success([
                    'token' => $token,
                ]);
            } catch (\Exception $e) {
                $this->fail($e->getMessage(), 500);
            }
        }

        return $this->success([
            'status' => 200,
//            'user' => DB::table('users')->where('phone', $data['phone'])->first(),
            'pass_key' => substr($data['phone'], -4),
        ]);
    }
}
