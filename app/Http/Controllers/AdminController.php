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
use App\Services\PostService;
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
    /** @var PostService */
    protected $postService;

    public function __construct()
    {
        $this->userRepository    = app(UserRepository::class);
        $this->postRepository    = app(PostRepository::class);
        $this->commentRepository = app(CommentRepository::class);
        $this->adminService      = app(AdminService::class);
        $this->postService       = app(PostService::class);
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

    public function dashboard()
    {
        $posts     = $this->postRepository->findWhere([['created_at', '>=', today()]]);
        $commentsInDay = $this->commentRepository->findWhere([['created_at', '>=', today()]])->count();
        $registerInDay = $this->userRepository->findWhere([['created_at', '>=', today()]])->count();
        $postInDay = $posts->count();
        $mostComments  = $this->postService->getPopularPostByField('count_comments');
        $mostLikes     = $this->postService->getPopularPostByField('count_votes');
        $mostViews     = $this->postService->getPopularPostByField('view');
        $pendingPosts  = $this->postRepository->getPendingPost();
        return view('Admin.dashboard.index', compact(
            'postInDay',
            'registerInDay',
            'commentsInDay',
            'mostComments',
            'mostLikes',
            'mostViews',
            'pendingPosts'
        ));
    }
}
