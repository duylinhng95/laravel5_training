<?php

namespace App\Services;

use App\Repository\AdminRepository;
use App\Repository\UserRepository;
use App\Repository\RocketProfileRepository;
use App\Repository\UserRepositoryEloquent;
use Hash;
use Auth;

class AdminService
{
    /** @var AdminRepository */
    protected $adminRepository;
    /** @var UserRepositoryEloquent */
    protected $userRepository;
    /** @var RocketProfileRepository */
    protected $rocketRepository;

    protected $authAdmin;

    public function __construct()
    {
        $this->adminRepository  = app(AdminRepository::class);
        $this->userRepository   = app(UserRepository::class);
        $this->rocketRepository = app(RocketProfileRepository::class);
        $this->authAdmin        = Auth::guard('admin');
    }

    /**
     * @return mixed
     * @throws \Exception
     */
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
        cache(['users' => $users], 3600);
        \DB::commit();
        return $rocket;
    }

    /**
     * @return bool
     * @throws \Exception
     */
    private function checkCached()
    {
        return cache()->has('users');
    }

    public function updatePassword($input)
    {
        $adminPwd = Auth::user()->password;
        $oldPwd   = $input['oldPwd'];
        $newPwd   = Hash::make($input['newPwd']);

        if ($this->checkOldPassword($adminPwd, $oldPwd)) {
            $id = Auth::id();
            $this->userRepository->update($id, ['password' => $newPwd]);

            return [true, 200, 'Password update successful'];
        }

        return [false, 401, 'Password not match'];
    }

    private function checkOldPassword($old, $input)
    {
        return Hash::check($input, $old);
    }

    public function login($input)
    {
        if ($this->authAdmin->attempt($input)) {
            $user = $this->authAdmin->user();
            if ($user->checkRole('admin')) {
                return [true, 200, 'Login Successful'];
            } else {
                $this->authAdmin->logout();
                return [false, 404, "You don't have permission to access this page"];
            }
        }

        return [false, 400, 'Wrong Credential'];
    }

    public function logout()
    {
        if ($this->authAdmin->check()) {
            $this->authAdmin->logout();
        }
        return redirect('/admin');
    }
}
