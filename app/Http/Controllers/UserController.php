<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryEloquent;
use App\Services\FollowService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    /** @var UserService */
    protected $userService;
    /** @var UserRepositoryEloquent */
    protected $userRepository;
    /** @var FollowService */
    protected $followService;

    public function __construct()
    {
        $this->userService    = app(UserService::class);
        $this->followService  = app(FollowService::class);
        $this->userRepository = app(UserRepository::class);
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function register(RegisterRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->userService->register($input);
        if (!$status) {
            return $this->error($code, $message);
        }
        $this->userService->login($input);
        return redirect()->route('post.index');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function login(LoginRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->userService->login($input);
        if ($status) {
            return redirect()->route('post.index');
        } else {
            return back()
                ->with(['code' => $code, 'message' => $message]);
        }
    }

    public function index()
    {
        $user = $this->userService->getInfo();
        return view('User.index', compact('user'));
    }

    public function logout()
    {
        return $this->userService->logout();
    }

    public function follow($id)
    {
        list ($userId, $followId) = $this->followService->followUser($id);
        return $this->success('Follow Success', ['user_id' => $userId, 'follower_id' => $followId]);
    }

    public function listUser(Request $request)
    {
        $params = $request->all();
        $users  = $this->userRepository->getUsers($params);

        return view('User.list', compact('users'));
    }

    public function redirectToProvider($provider)
    {
        return $this->userService->redirectToProvider($provider);
    }

    public function handleProviderCallback($provider)
    {
        list($status, $code, $message) = $this->userService->handleProviderCallback($provider);
        if ($status) {
            return redirect()->route('post.index');
        }

        return back()
            ->with(['code' => $code, 'message' => $message]);
    }
}
