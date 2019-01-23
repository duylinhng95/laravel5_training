<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Services\FollowService;
use Illuminate\Http\Request;
use App\Services\UserService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    /** @var UserService  */
    protected $userService;
    /** @var FollowService  */
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

    public function register(RegisterRequest $request)
    {
        $input  = $request->except('_token');
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

    public function login(Request $request)
    {
        $input  = $request->except('_token');
        list($status, $code, $message) = $this->userService->login($input);
        if ($status) {
            return redirect()->route('post.index');
        } else {
            return redirect()
                ->route('auth.login')
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
        return redirect()->route('user.index');
    }

    public function unfollow($id)
    {
        $this->followService->unfollowUser($id);
        return redirect()->route('user.index');
    }

    public function listUser(Request $request)
    {
        $users = $this->userService->paginate(10);
        if ($request->has('keyword')) {
            $users = $this->userService->search($request->input('keyword'));
        }
        return view('User.list', compact('users'));
    }
}
