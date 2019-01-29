<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Repository\UserRoleRepository;
use App\Repository\RocketProfileRepository;
use Auth;
use DB;
use Exception;
use Hash;
use App\Entities\User;

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

    public function register($input)
    {
        if (Auth::attempt($input)) {
            Auth::logout();
            return [false, 409, 'User already registered. Please login'];
        }
        return $this->checkRocketChatAndCreateAccount($input);
    }

    /**
     * @param $input
     * @return array
     * @throws Exception
     */
    private function checkRocketChatAndCreateAccount($input)
    {
        list($status, $code, $message, $data) = $this->userRepository->loginRocket($input);
        if ($status) {
            $rocket = $this->rocketRepository->findByFields('owner_id', $data['userId'])->first();
            if (is_null($rocket)) {
                return [false, 404, 'User not found'];
            }
        } else {
            return [$status, $code, $message];
        }

        $input['password'] = Hash::make($input['password']);
        $input['status']   = config('constant.user.status.verify');

        try {
            DB::beginTransaction();
            $this->userRepository->update($rocket->user_id, $input);

            $this->roleRepository->create(['role_id' => 1, 'user_id' => $rocket->user_id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return [true, 200, 'Login via RocketChat Successful'];
    }

    /**
     * @param $input
     * @return array
     * @throws Exception
     */
    public function login($input)
    {
        if ($user = Auth::guard()->attempt($input)) {
            return [true, 200, 'Login Successful'];
        }
        return $this->checkRocketChatAndCreateAccount($input);
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/login');
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
