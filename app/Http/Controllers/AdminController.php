<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function importUser()
    {
        $this->adminService->importUserDB();
        return response()->json(['status' => '200', 'message' => 'Import User Success']);
    }

    public function index()
    {
        $users = $this->adminService->getUsers();
        return view('Admin.index', compact('users'));
    }

    public function blockUser(Request $request)
    {
        $id = $request->id;
        $user = $this->adminService->block($id);
        return response()->json($user);
    }

    public function unblockUser(Request $request)
    {
        $id = $request->id;
        $user = $this->adminService->unblock($id);
        return response()->json($user);
    }

    public function listPost()
    {
        $posts = $this->adminService->getPosts();
        return view('Admin.post', compact('posts'));
    }
}
