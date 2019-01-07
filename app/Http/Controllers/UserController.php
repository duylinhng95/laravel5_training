<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repository\UserRepositoryEloquent;
use Hash;
use Auth;

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
        $input             = $request->except('_token');
        $input['password'] = Hash::make($input['password']);
        $this->userRepository->create($input);
        return redirect('/');
    }

    public function showLogin()
    {
        if (Auth::user() && Auth::user() != null) {
            return redirect('/post');
        }
        return view('User.login');
    }

    public function login(Request $request)
    {
        $input = $request->except('_token');

        if ($user = Auth::guard()->attempt($input)) {
            return redirect('/post');
        } else {
            return redirect('/auth/login')->with('error', 'Wrong credentials');
        }

    }

    public function logout()
    {
        if (Auth::user() && Auth::user() != null) {
            Auth::logout();
        }
        return redirect('/auth/login');
    }
}
