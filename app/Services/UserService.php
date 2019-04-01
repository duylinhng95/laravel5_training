<?php

namespace App\Services;

use App\Repository\UserRepositoryEloquent;
use App\Repository\RocketProfileRepositoryEloquent;
use Auth;

class UserService
{
    protected $userRepository;
    protected $rocketRepository;

    public function __construct()
    {
        $this->userRepository   = app(UserRepositoryEloquent::class);
        $this->rocketRepository = app(RocketProfileRepositoryEloquent::class);
    }

    /**
     * @param $input
     * @return array
     */
    public function register($input)
    {
        $user = $this->userRepository->loginRocket($input);
        if (isset($user['code'])) {
            return $user;
        }
        $rocket = $this->rocketRepository->findByFields('owner_id', $user['data']['userId'])->first();
        if (Auth::attempt($input)) {
            Auth::logout();
            return ['code' => 409, 'message' => 'User are already registered. Pleas login'];
        }
        $input['password'] = bcrypt($input['password']);
        $input['status']   = 1;
        $res               = $this->userRepository->update($rocket->user_id, 'id', $input);
        return $res;
    }

    public function login($input)
    {
        if ($user = Auth::guard()->attempt($input)) {
            return ['code' => 200, 'message' => 'Login successful'];
        } else {
            return ['code' => 401, 'message' => 'Wrong Credential'];
        }
    }

    public function logout()
    {
        if (Auth::user() && Auth::user() != null) {
            Auth::logout();
        }
        return redirect('/auth/login');
    }
}
