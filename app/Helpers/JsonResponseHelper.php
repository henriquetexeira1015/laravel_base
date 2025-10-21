<?php
namespace App\Helpers;

use Illuminate\Http\JsonResponse;

class JsonResponseHelper
{
    public static function jsonResponseFormater($response): JsonResponse
    {
        if ($response['success'] === false) {

            $response['status'] = $response['stauts'] ?? 400;

            return response()->json([
                'message' => $response['message'],
            ], $response['status']);
        }

        $response['status'] = $response['stauts'] ?? 200;

        return response()->json([
            'message' => $response['message'],
            'data' => $response['data'],
        ], $response['status']);
    }
}
