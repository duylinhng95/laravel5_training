<?php

namespace App\Traits;

trait ResponseTrait
{
    public function success($message, $data = null, $code = 200)
    {
        return $this->response(true, $code, $message, $data);
    }

    public function response($status, $code, $message, $data)
    {
        return response()->json([$status, 'message' => $message, 'data' => $data], $code);
    }

    public function error($code, $message, $data = null)
    {
        return $this->response(false, $code, $message, $data);
    }
}
