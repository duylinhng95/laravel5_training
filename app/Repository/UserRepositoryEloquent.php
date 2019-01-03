<?php
namespace App\Repository;

use App\Entities\User;
use App\Repository\UserRepository;
use App\Repository\BaseRepositoryEloquent;
use Illuminate\Http\Request;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    public function model(){
        return User::class;
    }
}