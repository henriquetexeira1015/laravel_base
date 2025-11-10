<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class JsonResponseHelper
{
    public static function jsonResponseFormater($response): JsonResponse
    {
        if ($response['success'] === false) {

            $response['status'] = $response['status'] ?? 400;

            return response()->json([
                'message' => $response['message'],
            ], $response['status']);
        }

        $response['status'] = $response['status'] ?? 200;

        $response['data'] = $response['data'] ?? null;

        return response()->json([
            'success' => $response['success'],
            'message' => $response['message'],
            'data' => $response['data'],
        ], $response['status']);
    }
}