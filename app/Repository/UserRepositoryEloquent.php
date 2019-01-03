<?php
namespace App\Repository;

use App\Entities\User;
use App\Repository\UserRepository;
use App\Repository\BaseRepositoryEloquent;
use Illuminate\Http\Request;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserRepositoryEloquent extends BaseRepositoryEloquent implements UserRepository
{
    public function model(){
        return User::class;
    }

    public function login($input){
        $token = JWTAuth::attempt($input);
        try {
            if (!$token) {
                return response()->json(['invalid_email_or_password'], 422);
            }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        return response()->json(compact('token'));
    }
}
