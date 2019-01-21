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
        $params = ['email' => config('rocket.username'), 'password' => config('rocket.password')];
        list($status, $code, $message, $user) = $this->loginAPI($params);
        if ($status) {
            $headers = [
                'X-Auth-Token' => $user['authToken'],
                'X-User-Id'    => $user['userId'],
            ];
            $request = new Client();
            try {
                $res = $request->get(config("rocket.url").'/users.list?count=0', ['headers' => $headers]);
            } catch (Exception $e) {
                return [false, 'code' => $e->getCode(), 'message' => $e->getMessage()];
            }
            $res = json_decode($res->getBody()->getContents(), true);
            return [true, 200, 'Retrieve users Successful', $res['users']];
        } else {
            return [$status, $code, $message];
        }
    }
}
