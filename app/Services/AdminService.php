<?php

namespace App\Services;

use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use App\Repository\RocketProfileRepository;
use App\Repository\PostRepository;

class AdminService
{
    protected $adminRepository;
    protected $userRepository;
    protected $rocketRepository;
    protected $postRepository;

    public function __construct()
    {
        $this->adminRepository  = app(AdminRepository::class);
        $this->userRepository   = app(UserRepository::class);
        $this->rocketRepository = app(RocketProfileRepository::class);
        $this->postRepository   = app(PostRepository::class);
    }

    public function importUserDB()
    {
        $arr = $this->adminRepository->getUser();
        if ($arr['code']) {
            throw new \Exception(['code' => $arr['code'], 'message' => $arr['message']]);
        }

        $users = [];

        foreach ($arr['users'] as $user) {
            $users[] = [
                'user'   => ['name' => $user['name']],
                'rocket' => ['owner_id' => $user['_id'], 'username' => $user['username']],
            ];
        }

        try {
            \DB::beginTransaction();
            $res    = $this->userRepository->createProfile($users);
            $rocket = $this->rocketRepository->createProfile($res);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        \DB::commit();

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

    public function searchUsers($keyword)
    {
        return $this->userRepository->search($keyword);
    }

    public function sort($section, $order)
    {
        return $this->userRepository->sort($section, $order);
    }
}
