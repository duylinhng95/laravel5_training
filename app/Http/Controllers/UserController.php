<?php

namespace App\Http\Controllers;

use App\Services\FollowService;
use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;
    protected $followService;

    public function __construct()
    {
        $this->userService   = app(UserService::class);
        $this->followService = app(FollowService::class);
    }

    public function showRegister()
    {
        return view('User.register');
    }

    public function register(Request $request)
    {
        $input  = $request->except('_token');
        $result = $this->userService->register($input);
        if (isset($result['code'])) {
            return view('User.register', compact('result'));
        }
        $this->userService->login($input);
        return redirect('/user');
    }

    public function showLogin()
    {
        return view('User.login');
    }

    public function login(Request $request)
    {
        $input  = $request->except('_token');
        $result = $this->userService->login($input);
        if ($result['code'] == 200) {
            return redirect('/');
        } else {
            return redirect('/auth/login')->with($result);
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
        return redirect('/user');
    }

    public function unfollow($id)
    {
        $this->followService->unfollowUser($id);
        return redirect('/user');
    }
}
