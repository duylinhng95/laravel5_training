<?php
namespace App\Services;

use App\Traits\AdminTrait;
use GuzzleHttp\Client;

class AdminService
{
    use AdminTrait;

    public function getUsersArray()
    {
        $user = $this->loginAPI();
        $headers = [
            'X-Auth-Token' => $user['data']['authToken'],
            'X-User-Id' => $user['data']['userId'],
        ];
        $request = new Client();
        $res = $request->get('https://neolab.wc.calling.fun/api/v1/users.list?count=0', ['headers' => $headers]);
        return json_decode($res->getBody()->getContents(), true);
    }
}
