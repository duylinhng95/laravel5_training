<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
    }

    public function import()
    {
        $this->adminService->importUserDB();
        return $this->success('Import User Successful');
    }

    public function block(Request $request)
    {
        $id   = $request->input('id');
        $user = $this->adminService->block($id);
        return $this->json($this->success('Block User Successful', $user));
    }

    public function unblock(Request $request)
    {
        $id   = $request->input('id');
        $user = $this->adminService->unblock($id);
        return $this->json($this->success('Unblock User Successful', $user));
    }
}
