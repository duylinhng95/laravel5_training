<?php

namespace App\Services;

use App\Repository\UserRepository;
use App\Repository\UserRepositoryEloquent;
use App\Repository\UserRoleRepository;
use App\Repository\RocketProfileRepository;
use Auth;
use DB;
use Exception;
use Hash;
use Socialite;

class UserService
{
    /** @var UserRepositoryEloquent */
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
     * @throws Exception
     */
    public function register($input)
    {
        $status = strpos($input['email'], '@neo-lab.vn');
        if ($status === false) {
            $input['password'] = Hash::make($input['password']);
            $input['status']   = config('constant.user.status.verify');
            try {
                DB::beginTransaction();
                $userId = $this->userRepository->create($input);
                $this->roleRepository->create([
                    'role_id' => config('constant.user.role.user'),
                    'user_id' => $userId->id
                ]);
                DB::commit();
            } catch (Exception $e) {
                DB::rollBack();
                throw $e;
            }

            return [true, 200, 'Register Successful'];
        }

        return [false, 409, 'User already registered as NeoLab. Please login'];
    }

    /**
     * @param $input
     * @return array
     * @throws Exception
     */
    public function login($input)
    {
        if (Auth::guard()->attempt($input)) {
            $user = Auth::user();
            if ($user->checkRole('admin')) {
                Auth::logout();
                return [false, 404, 'Wrong Credential'];
            } else {
                return [true, 200, 'Login Successful'];
            }
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

        $params['email']    = $input['email'];
        $params['password'] = Hash::make($input['password']);
        $params['status']   = config('constant.user.status.verify');

        try {
            DB::beginTransaction();
            $this->userRepository->update($rocket->user_id, $params);

            $this->roleRepository->create(['role_id' => 1, 'user_id' => $rocket->user_id]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Auth::guard()->attempt($input);
        return [true, 200, 'Login via RocketChat Successful'];
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
        }
        return redirect('/');
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

    public function checkLogin($input)
    {
        $email    = $input['email'];
        $password = $input['password'];
        //        Login via Database
        $response = $this->userRepository->findByFields('email', $email);
        if (count($response) === 0) {
            $emailSplit = explode('@', $email);

            if ($emailSplit[1] === 'neo-lab.vn') {
                return $this->userRepository->loginRocket($input);
            }

            return [false, 404, 'User not found'];
        }
        $userPwd = $response[0]->password;
        $result  = Hash::check($password, $userPwd);

        if ($result) {
            return [$result, 200, 'Input is valid'];
        } else {
            return [$result, 401, 'Wrong password'];
        }
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $params = [];

        $params['name']        = $providerUser->name;
        $params['email']       = $providerUser->email;
        $params['provider']    = $provider;
        $params['provider_id'] = $providerUser->id;

        /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
        $user = $this->userRepository->firstOrCreate($params);

        Auth::login($user);

        return [true, 200, 'User login Success'];
    }
}
