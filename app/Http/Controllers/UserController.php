<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;

class UserController extends Controller
{
    protected $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function showRegister()
    {
        return view('User.register');
    }

    public function register(Request $request)
    {
        $input = $request->except('_token');
        $result = $this->userService->register($input);
        if(isset($result['code'])){
            return view('User.register', compact('result'));
        }
        return $this->userService->login($input);
    }

    public function showLogin()
    {
        return view('User.login');
    }

    public function login(Request $request)
    {
        $input = $request->except('_token');
        $this->userService->login($input);
        return redirect('/user');
    }

    public function index()
    {
        return redirect('/post');
    }
}
