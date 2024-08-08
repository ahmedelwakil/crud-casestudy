<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * @param array|null $payload
     * @param int $statusCode
     * @param string $message
     * @return JsonResponse
     */
    protected function response(?array $payload, int $statusCode, string $message = null)
    {
        $response = [
            "payload" => $payload,
        ];

        if ($message) {
            $response["message"] = $message;
        }

        return response()->json($response, $statusCode, [], JSON_INVALID_UTF8_IGNORE);
    }
}
