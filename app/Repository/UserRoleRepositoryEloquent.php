<?php

namespace App\Repository;

use App\Entities\UserRole;

class UserRoleRepositoryEloquent extends BaseRepositoryEloquent implements UserRoleRepository
{
    public function model()
    {
        return UserRole::class;
    }
}
