<?php

namespace App\Repository;

use App\Repository\AdminRepository;
use App\Entities\User;
use App\Traits\AdminTrait;
use GuzzleHttp\Client;

class AdminRepositoryEloquent implements AdminRepository
{
    use AdminTrait;

    public function getUser()
    {
        $user    = $this->loginAPI();
        $headers = [
            'X-Auth-Token' => $user['data']['authToken'],
            'X-User-Id'    => $user['data']['userId'],
        ];
        $request = new Client();
        $res     = $request->get('https://neolab.wc.calling.fun/api/v1/users.list?count=0', ['headers' => $headers]);

        return json_decode($res->getBody()->getContents(), true);
    }
}
