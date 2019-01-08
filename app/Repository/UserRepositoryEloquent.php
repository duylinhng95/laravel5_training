<?php

namespace App\Repository;

use App\Entities\User;
use App\Repository\UserRepository;
use App\Repository\BaseRepositoryEloquent;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    public function model()
    {
        return User::class;
    }

    public function createProfile($users)
    {
        foreach ($users as $u)
        {
            $id = $this->model->firstOrCreate($u['user'])->id;
            $rocket = $u['rocket'];
            $rocket['user_id'] = $id;
            $rockets[] = $rocket;
        }
        return $rockets;
    }

    public function paginate($num)
    {

        return $this->model->paginate($num);
    }
}
