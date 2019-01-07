<?php

namespace App\Repository;

use App\Repository\AdminRepository;
use App\Repository\BaseRepositoryEloquent;
use App\Services\AdminService;
use App\Entities\User;

class AdminRepositoryEloquent implements AdminRepository
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function getUser()
    {
        $arr = $this->adminService->getUsersArray();
        foreach ($arr['users'] as $user) {
            $users[] = ['name' => $user['name'], 'status' => 0, 'role' => 0];
        }
    }
}
