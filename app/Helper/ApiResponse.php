<?php

namespace App\Helper;

class ApiResponse
{
    public function __construct()
    {
        //
    }

    /**
     * Success formatter.
     */
    public static function success($message = null, $data = [], $statusCode = 200)
    {
        return response()->json([
            'success' => true,
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Error formatter.
     */
    public static function error($message = null, $statusCode = 500, $data = [])
    {
        return response()->json([
            'success' => false,
            'code' => $statusCode,
            'message' => $message,
            'data' => $data,
        ], $statusCode);
    }

    /**
     * Validation error formatter.
     */
    public static function validationError($message = 'validation failed', $errors = [], $statusCode = 422)
    {
        return response()->json([
            'success' => false,
            'code' => $statusCode,
            'message' => $message,
            'errors' => $errors,
        ], $statusCode);
    }
}
