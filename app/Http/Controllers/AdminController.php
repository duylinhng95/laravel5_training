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
        if ($request->input('keywords')) {
            $users = $this->adminService->searchUsers($request->input('keywords'));
        }
        return view('Admin.user.index', compact('users'));
    }
}
