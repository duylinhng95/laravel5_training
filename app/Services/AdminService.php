<?php

namespace App\Services;

use App\Repository\AdminRepositoryEloquent;
use App\Repository\UserRepositoryEloquent;
use App\Repository\RocketProfileRepositoryEloquent;

class AdminService
{
    protected $adminRepository;
    protected $userRepository;
    protected $rocketRepository;

    public function __construct()
    {
        $this->adminRepository  = app(AdminRepositoryEloquent::class);
        $this->userRepository   = app(UserRepositoryEloquent::class);
        $this->rocketRepository = app(RocketProfileRepositoryEloquent::class);
    }

    public function importUserDB()
    {
        $arr = $this->adminRepository->getUser();

        foreach ($arr['users'] as $user) {
            $users[] = [
                'user'   => ['name' => $user['name']],
                'rocket' => ['owner_id' => $user['_id'], 'username' => $user['username']],
            ];
        }

        $res    = $this->userRepository->createProfile($users);
        $rocket = $this->rocketRepository->createMany($res);

        return $rocket;
    }

    public function getUser()
    {
        return $this->userRepository->paginate(50);
    }

    public function block($id)
    {
        return $this->userRepository->blocked($id);
    }

    public function unblock($id)
    {
        return $this->userRepository->unBlocked($id);
    }

}
