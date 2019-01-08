<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

Trait AdminTrait
{

    public function loginAPI()
    {
        $username = config('rocket.username');
        $password = config('rocket.password');
        $body     = json_encode([
            'user'     => $username,
            'password' => $password
        ]);
        $request  = new Client();
        $res      = $request->post("https://neolab.wc.calling.fun/api/v1/login",
            ['headers' => ['Content-Type' => 'application/json'], 'body' => $body]);
        return json_decode($res->getBody()->getContents(), true);
    }
}
