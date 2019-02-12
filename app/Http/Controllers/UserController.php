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

    public function showRegister()
    {
        return view('User.register');
    }

    public function register(RegisterRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->userService->register($input);
        if (!$status) {
            return view('User.register', compact('status', 'code', 'message'));
        }
        $this->userService->login($input);
        return redirect()->route('post.index');
    }

    public function showLogin()
    {
        return view('User.login');
    }

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
        $this->followService->followUser($id);
        return $this->success('Follow Success', $id);
    }

    public function listUser(Request $request)
    {
        $users = $this->userRepository->getUsers($request);

        return view('User.list', compact('users'));
    }

    public function checkInputRegister(RegisterRequest $request)
    {
        return $request;
    }

    public function checkInputLogin(LoginRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->userService->login($input);
        if ($status) {
            return $this->success("Input Valid");
        }
        return $this->error($code, $message);
    }
}
