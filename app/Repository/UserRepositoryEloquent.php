<?php

namespace App\Repository;

use App\Entities\User;
use App\Repository\UserRepository;
use App\Repository\BaseRepositoryEloquent;
use App\Traits\RocketTrait;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    use RocketTrait;

    public function model()
    {
        return User::class;
    }

    public function createProfile($users)
    {
        $rockets = [];
        foreach ($users as $u) {
            $id                = $this->model->firstOrCreate($u['user'])->id;
            $rocket            = $u['rocket'];
            $rocket['user_id'] = $id;
            $rockets[]         = $rocket;
        }
        return $rockets;
    }

    public function blocked($id)
    {
        $user         = $this->model->find($id);
        $user->status = 2;
        $user->save();

        return $user;
    }

    public function unblocked($id)
    {
        $user = $this->model->find($id);
        if (!empty($user->email)) {
            $user->status = 1;
        } else {
            $user->status = 0;
        }
        $user->save();
        return $user;
    }

    public function loginRocket($input)
    {
        $user = $this->loginAPI($input);
        return $user;
    }
}
