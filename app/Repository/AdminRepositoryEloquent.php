<?php

namespace App\Repository;

use App\Repository\AdminRepository;
use App\Entities\User;
use App\Traits\RocketTrait;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException as Exception;

class AdminRepositoryEloquent implements AdminRepository
{
    use RocketTrait;

    public function getUser()
    {
        $params  = ['email' => config('rocket.username'), 'password' => config('rocket.password')];
        $user    = $this->loginAPI($params);
        $headers = [
            'X-Auth-Token' => $user['data']['authToken'],
            'X-User-Id'    => $user['data']['userId'],
        ];
        $request = new Client();
        try {
            $res = $request->get('https://neolab.wc.calling.fun/api/v1/users.list?count=0', ['headers' => $headers]);
        } catch (Exception $e) {
            return [false ,'code' => $e->getCode(), 'message' => $e->getMessage()];
        }
        $res = json_decode($res->getBody()->getContents(), true);
        return [true, 200, 'Retrieve users Successful', $res['users']];
    }
}
