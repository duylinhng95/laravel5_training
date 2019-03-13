<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

trait RocketTrait
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
            $res = $request->post(config('rocket.url') . "/login", [
                'headers' => ['Content-Type' => 'application/json'],
                'body'    => $body
            ]);
        } catch (ClientException $e) {
            return [
                false,
                $e->getCode(),
                'Login via NeoLab error: Wrong credentials',
                null,
            ];
        }
        $res = json_decode($res->getBody()->getContents(), true);
        return [true, 200, 'Login via API success', $res['data']];
    }
}
