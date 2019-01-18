<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Traits\ResponseTrait;

class AdminController extends Controller
{
    use ResponseTrait;

    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function index(Request $request)
    {
        $users = $this->adminService->getUsers();
        if ($request->has('keywords')) {
            $users = $this->adminService->searchUsers($request->input('keywords'));
        }

        if ($request->has('sort')) {
            $users = $this->adminService->sort($request->input('sort'), $request->input('order'));
        }
        return view('Admin.user.index', compact('users'));
    }
}
