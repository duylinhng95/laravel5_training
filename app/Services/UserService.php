<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Repository\UserRoleRepository;
use App\Repository\RocketProfileRepository;
use Auth;
use DB;
use Exception;
use Hash;

class UserService
{

    protected $userRepository;
    protected $rocketRepository;
    protected $roleRepository;

    public function __construct()
    {
        $this->userRepository   = app(UserRepository::class);
        $this->rocketRepository = app(RocketProfileRepository::class);
        $this->roleRepository   = app(UserRoleRepository::class);
    }

    /**
     * @param $input
     * @return array
     * @throws \Exception
     */
    public function register($input)
    {
        list($status, $code, $message, $data) = $this->userRepository->loginRocket($input);
        if ($status) {
            $rocket = $this->rocketRepository->findByFields('owner_id', $data['userId'])->first();
        } else {
            return [$status, $code, $message];
        }

        if (Auth::attempt($input)) {
            Auth::logout();
            return [false, 409, 'User already registered. Please login'];
        }

        $input['password'] = Hash::make($input['password']);

        try {
            DB::beginTransaction();
            $this->userRepository->update($rocket->user_id, $input);

            $this->roleRepository->create(['role_id' => 1, 'user_id' => $rocket->user_id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return [true, 200, 'Register Successful'];
    }

    public function login($input)
    {
        if ($user = Auth::guard()->attempt($input)) {
            return [true, 200, 'Login Successful'];
        } else {
            return [false, 401, 'Wrong Credentials'];
        }
    }

    public function logout()
    {
        if (checkLogin()) {
            Auth::logout();
        }
        return redirect('/auth/login');
    }

    public function followUser($id)
    {
        $userId = Auth::id();
        return $this->userRepository->followUser($id, $userId);
    }

    public function getInfo()
    {
        return $this->userRepository->getInfo();
    }
}
