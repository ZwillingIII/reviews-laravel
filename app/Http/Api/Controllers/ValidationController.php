<?php

namespace App\Http\Api\Controllers;

use Illuminate\Http\Request;

class ValidationController extends BaseController
{
    public function phoneValidate(Request $request)
    {
        try {
            $data = $request->validate([
                'phone' => 'required|min:11|max:11',
            ]);

            return $this->success([
                'data' => $data,
                'status' => 200,
            ]);
        } catch (\Exception $e) {
            return $this->fail($e->getMessage(), 500);
        }
    }
}
