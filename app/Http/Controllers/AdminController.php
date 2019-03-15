<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Repository\CommentRepository;
use App\Repository\CommentRepositoryEloquent;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryEloquent;
use App\Services\AdminService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /** @var UserRepositoryEloquent */
    protected $userRepository;
    /** @var AdminService */
    protected $adminService;
    /** @var PostRepositoryEloquent */
    protected $postRepository;
    /** @var CommentRepositoryEloquent */
    protected $commentRepository;

    public function __construct()
    {
        $this->userRepository    = app(UserRepository::class);
        $this->postRepository    = app(PostRepository::class);
        $this->commentRepository = app(CommentRepository::class);
        $this->adminService      = app(AdminService::class);
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $users  = $this->userRepository->getUsers($params);
        return view('Admin.user.index', compact('users'));
    }

    public function showPassword()
    {
        return view('Admin.password');
    }

    public function storePassword(Request $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->adminService->updatePassword($input);

        if ($status) {
            return redirect()->route('admin.password')->with(['code' => $code, 'message' => $message]);
        }

        return redirect()->route('admin.password')->with(['code' => $code, 'message' => $message]);
    }

    public function showLogin()
    {
        return view('Admin.login');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->adminService->login($input);
        if ($status) {
            return redirect()->route('admin.index');
        } else {
            return back()
                ->with(['code' => $code, 'message' => $message]);
        }
    }

    public function dashboard()
    {
        $postInDay     = $this->postRepository->findWhere([['created_at', '>=', today()]])->count();
        $commentsInDay = $this->commentRepository->findWhere([['created_at', '>=', today()]])->count();
        $registerInDay = $this->userRepository->findWhere([['created_at', '>=', today()]])->count();
        return view('Admin.dashboard.index', compact('postInDay', 'registerInDay', 'commentsInDay'));
    }
}
