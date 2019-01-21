<?php

namespace App\Services;

use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use App\Repository\RocketProfileRepository;
use Illuminate\Support\Facades\Cache;

class AdminService
{
    /** @var AdminRepository */
    protected $adminRepository;
    /** @var UserRepository */
    protected $userRepository;
    /** @var RocketProfileRepository */
    protected $rocketRepository;

    public function __construct()
    {
        $this->adminRepository  = app(AdminRepository::class);
        $this->userRepository   = app(UserRepository::class);
        $this->rocketRepository = app(RocketProfileRepository::class);
    }

    public function importUserDB()
    {
        $checkCached = $this->checkCached();
        if (!$checkCached) {
            list($status, $code, $message, $data) = $this->adminRepository->getUser();
            if (!$status) {
                throw new \Exception(['code' => $code, 'message' => $message]);
            }

            $users = [];
            foreach ($data as $user) {
                $users[] = [
                    'user'   => ['name' => $user['name']],
                    'rocket' => ['owner_id' => $user['_id'], 'username' => $user['username']],
                ];
            }
        } else {
            $users = cache('users');
        }
        try {
            \DB::beginTransaction();
            $res    = $this->userRepository->createProfile($users);
            $rocket = $this->rocketRepository->createProfile($res);
        } catch (\Exception $e) {
            \DB::rollback();
            throw $e;
        }
        Cache::put('users', $users, 3600);
        \DB::commit();
        return $rocket;
    }

    private function checkCached()
    {
        return cache()->has('users');
    }
}
