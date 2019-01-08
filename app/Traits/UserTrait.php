<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait UserTrait
{
    public function loginAPI($input)
    {
        $username = $input['email'];
        $password = $input['password'];
        $body     = json_encode([
            'user'     => $username,
            'password' => $password
        ]);
        $request  = new Client();
        try {
            $res = $request->post("https://neolab.wc.calling.fun/api/v1/login",
                ['headers' => ['Content-Type' => 'application/json'], 'body' => $body]);
        } catch (ClientException $e) {
            return ['code' => $e->getCode(), 'message' => 'Unauthorized Error'];
        }
        return json_decode($res->getBody()->getContents(), true);
    }
}
