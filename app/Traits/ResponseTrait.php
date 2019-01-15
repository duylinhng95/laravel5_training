<?php

namespace App\Traits;

trait ResponseTrait
{
    public function response($code, $message, $data)
    {
        return ['code' => $code, 'message' => $message, 'data' => $data];
    }

    public function success($message, $data = null, $code = 200)
    {
        return $this->response($code, $message, $data);
    }

    public function error($code, $message, $data = null)
    {
        return $this->response($code, $message, $data);
    }

    public function json($response)
    {
        return response()->json($response);
    }
}
