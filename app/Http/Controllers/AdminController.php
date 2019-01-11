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

    public function index()
    {
        $users = $this->adminService->getUsers();
        return view('Admin.user.index', compact('users'));
    }
}
