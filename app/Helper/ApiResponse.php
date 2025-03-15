<?php

namespace App\Helper;

use Illuminate\Http\JsonResponse;

class ApiResponse
{
    public static function successResponse($data = [], $message = '', $status='success' , $statusCode = 200): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    public static function errorResponse($message = null, $status='error' , $statusCode = 500): JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $statusCode);
    }
}
