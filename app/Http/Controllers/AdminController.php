<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Services\PostService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
        $this->postService = app(PostService::class);
    }

    public function importUser()
    {
        $this->adminService->importUserDB();
        return response()->json(['status' => '200', 'message' => 'Import User Success']);
    }

    public function index()
    {
        $users = $this->adminService->getUsers();
        return view('Admin.user.index', compact('users'));
    }

    public function blockUser(Request $request)
    {
        $id = $request->input('id');
        $user = $this->adminService->block($id);
        return response()->json($user);
    }

    public function unblockUser(Request $request)
    {
        $id = $request->input('id');
        $user = $this->adminService->unblock($id);
        return response()->json($user);
    }

    public function listPost()
    {
        $posts = $this->postService->paginate(50);
        return view('Admin.post.index', compact('posts'));
    }

    public function showPost($id)
    {
        list($post, $tags) = $this->postService->find($id);
        return view('Admin.post.detail', compact('post', 'tags', 'user'));
    }
}
