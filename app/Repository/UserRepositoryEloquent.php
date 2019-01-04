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
}
