<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Handler\CurlHandler;

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
        $handler = new CurlHandler();
        $stack = HandlerStack::create($handler);
        $request  = new Client(['handler' => $stack]);
        $res      = $request->post("https://neolab.wc.calling.fun/api/v1/login",
            ['headers' => ['Content-Type' => 'application/json'], 'body' => $body]);
        return json_decode($res->getBody()->getContents(),true);

//        $ch = curl_init('https://neolab.wc.calling.fun/api/v1/login');
//        curl_setopt($ch, CURLOPT_POST, true);
//        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//        curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
//        $res = curl_exec($ch);
//        dd(json_decode($res));
    }
}
