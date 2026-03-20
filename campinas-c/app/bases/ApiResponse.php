<?php

namespace App\bases;

use Illuminate\Http\Exceptions\HttpResponseException;

class ApiResponse
{
    static public function errorResponse($status, $message)
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => $message
        ], $status),);
    }

    static public function response($status, $message)
    {
        return response()->json($message, $status);
    }

    static public function responseDefault($status, $message)
    {
        return response()->json([
            'success' => true,
            'data' => $message
        ], $status);
    }

    static public function responseThrow($status, $message)
    {
        throw new HttpResponseException(response()->json($message, $status),);
    }
}
