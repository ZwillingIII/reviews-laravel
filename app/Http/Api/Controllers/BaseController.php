<?php

namespace App\Http\Api\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    public function fail($message = null, int $status = 500, int $error_code = 0)
    {
        $context = [
            'success' => false,
            'error' => [
                'code' => $error_code,
                'message' => $message,
                'reason' => $message,
            ],
        ];
        return response()->json($context, $status);
    }

    /**
     * Success response
     *
     * @param $result
     * @param bool $prettyPrint
     * @return JsonResponse
     */
    public function success($result = [], bool $prettyPrint = true): JsonResponse
    {
        $response = ['success' => true];
        if (!empty($result)) {
            $response['result'] = $result;
        }
        return response()->json($response, 200, [], $prettyPrint ? JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_PRESERVE_ZERO_FRACTION : 0);
    }
}
