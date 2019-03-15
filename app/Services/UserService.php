<?php

namespace App\Services;

use App\Entities\User;
use App\Repository\InterestRepository;
use App\Repository\InterestRepositoryEloquent;
use App\Repository\RocketProfileRepositoryEloquent;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryEloquent;
use App\Repository\UserRoleRepository;
use App\Repository\RocketProfileRepository;
use App\Repository\UserRoleRepositoryEloquent;
use Auth;
use DB;
use Exception;
use Hash;
use Illuminate\Http\UploadedFile;
use Socialite;

class UserService
{
    /** @var UserRepositoryEloquent */
    protected $userRepository;
    /** @var RocketProfileRepositoryEloquent */
    protected $rocketRepository;
    /** @var UserRoleRepositoryEloquent */
    protected $roleRepository;
    /** @var InterestRepositoryEloquent */
    protected $interestRepository;

    public function __construct()
    {
        $this->userRepository     = app(UserRepository::class);
        $this->rocketRepository   = app(RocketProfileRepository::class);
        $this->roleRepository     = app(UserRoleRepository::class);
        $this->interestRepository = app(InterestRepository::class);
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
            /** @var User $user */
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

    /**
     * @param $provider
     * @return array
     * @throws Exception
     */
    public function handleProviderCallback($provider)
    {
        $providerUser = Socialite::driver($provider)->user();
        $params       = [
            'email'       => $providerUser->email,
            'name'        => $providerUser->name,
            'provider'    => $provider,
            'provider_id' => $providerUser->id,
            'status'      => config('constant.user.status.verify')
        ];


        try {
            DB::beginTransaction();
            /** @var \Illuminate\Contracts\Auth\Authenticatable $user */
            $user = $this->userRepository->firstOrCreate(['email' => $params['email']], $params);
            $this->roleRepository->firstOrCreate(['user_id' => $user->id], [
                'role_id' => config('constant.user.role.user'),
            ]);
            DB::commit();
        } catch (Exception $e) {
            DB::rollBack();
            throw $e;
        }
        Auth::login($user);

        return [true, 200, 'User login Success'];
    }

    public function updateAvatar($params)
    {
        $userId = $params['user_id'];
        /** @var UploadedFile $file */
        $file     = $params['avatar_img'];
        $user     = $this->userRepository->find($userId);
        $pathName = public_path('/images/' . $user->email);
        $filename = 'avatar.' . $file->getClientOriginalExtension();
        try {
            $file->move($pathName, $filename);
        } catch (\Exception $e) {
            return [false, $e->getMessage()];
        }
        $user->avatar = "images/{$user->email}/{$filename}";
        $user->save();
        return [true, 'Uploaded file success'];
    }

    public function createUser($params)
    {
        $params['password'] = Hash::make($params['password']);
        return $this->userRepository->create($params);
    }

    public function updateUser($id, $params)
    {
        if (is_null($params['password'])) {
            unset($params['password']);
        }

        return $this->userRepository->update($id, $params);
    }

    public function blockUser($id)
    {
        $user = $this->userRepository->find($id);
        if ($user->status !== config('constant.user.status.block')) {
            $this->userRepository->blocked($id);
            return [true, 200, 'User has been blocked', ['status' => 'Block']];
        }

        $user = $this->userRepository->unblocked($id);

        $status = "Active";
        if ($user->status !== config('constant.user.status.verify')) {
            $status = 'Not Active';
        }

        return [true, 200, "User has been unblocked", ['status' => $status]];
    }

    public function getRegisterByDay()
    {
        $date  = today();
        $users = $this->userRepository->findWhere([['created_at', '>=', $date]])
            ->groupBy('status');

        if ($users->isEmpty()) {
            return [false, 404, 'No User register today', null];
        }

        $data = [];
        foreach ($users->toArray() as $key => $user) {
            switch ($key) {
                case 2:
                    $element['label'] = 'Block';
                    $element['value'] = count($user);
                    break;
                case 1:
                    $element['label'] = 'Verify';
                    $element['value'] = count($user);
                    break;
                default:
                    $element['label'] = 'Not Verify';
                    $element['value'] = count($user);
            }
            $data[] = $element;
        }
        sort($data);
        $colors = ['#d63031', '#fdcb6e', '#00b894'];
        return [true, 200, 'Get User register today success', ['data' => $data, 'colors' => $colors]];
    }
}
