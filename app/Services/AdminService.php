<?php

namespace App\Services;

use App\Repository\AdminRepositoryEloquent;
use App\Repository\UserRepositoryEloquent;
use App\Repository\RocketProfileRepositoryEloquent;
use App\Repository\PostRepositoryEloquent;

class AdminService
{
    protected $adminRepository;
    protected $userRepository;
    protected $rocketRepository;
    protected $postRepository;

    public function __construct()
    {
        $this->adminRepository  = app(AdminRepositoryEloquent::class);
        $this->userRepository   = app(UserRepositoryEloquent::class);
        $this->rocketRepository = app(RocketProfileRepositoryEloquent::class);
        $this->postRepository   = app(PostRepositoryEloquent::class);
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
        $rocket = $this->rocketRepository->createProfile($res);

        return $rocket;
    }

    public function getUsers()
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

    public function getPosts()
    {
        return $this->postRepository->all();
    }
}
