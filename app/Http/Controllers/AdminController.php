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
        $users = $this->adminService->getUser();
        return view('Admin.index', compact('users'));
    }
}
