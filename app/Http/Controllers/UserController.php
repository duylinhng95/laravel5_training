<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepositoryEloquent;
use Hash;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepositoryEloquent::class);
    }

    public function showRegister()
    {
        return view('User.register');
    }

    public function register(Request $request)
    {
        $input = $request->except('_token');
        $input['password'] = Hash::make($input['password']);
        $this->userRepository->create($input);

        return redirect('/');
    }

    public function showLogin()
    {
        return view('User.login');
    }

    public function login(Request $request)
    {
        $input = $request->except('_token');
        $this->userRepository->login($input);
    }
}
