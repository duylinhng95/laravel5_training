<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Repository\UserRoleRepository;
use App\Repository\RocketProfileRepository;
use App\Traits\ResponseTrait;
use Auth;
use Illuminate\Support\Facades\DB;

class UserService
{
    use ResponseTrait;

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
        $user = $this->userRepository->loginRocket($input);
        if (isset($user['code'])) {
            return $user;
        }

        $rocket = $this->rocketRepository->findByFields('owner_id', $user['data']['userId'])->first();
        if (Auth::attempt($input)) {
            Auth::logout();
            return $this->error('409', 'User are already registered. Please login');
        }

        $input['password'] = bcrypt($input['password']);
        DB::beginTransaction();

        try {
            $this->userRepository->update($rocket->user_id, $input);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        try {
            $this->roleRepository->create(['role_id' => 1, 'user_id' => $rocket->user_id]);
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }

        DB::commit();
        return $this->success('User register successful');
    }

    public function login($input)
    {
        if ($user = Auth::guard()->attempt($input)) {
            return $this->success('Login Successful');
        } else {
            return $this->error('401', 'Wrong Credentials');
        }
    }

    public function logout()
    {
        if (Auth::user() && Auth::user() != null) {
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
