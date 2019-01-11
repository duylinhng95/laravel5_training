<?php

namespace App\Traits;

trait ResponseTrait
{
    public function responseCode($code, $message)
    {
        return response()->json(['code' => $code, 'message' => $message]);
    }

    public function responseObject($var)
    {
        return response()->json($var);
    }
}
