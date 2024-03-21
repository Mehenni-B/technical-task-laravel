<?php

namespace App\Traits;

trait HttpResponseTrait
{
    public function errorHttpResponse($message, $statusCode)
    {
        return response([
            'status' => false,
            'message' => $message
        ], $statusCode);
    }

    public function successHttpResponse($message = "", $data, $statusCode = 200)
    {
        return response([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }
}
