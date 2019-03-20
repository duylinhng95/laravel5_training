<?php

namespace App\Http\Controllers\Admin;

use App\Services\AdminService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    /** @var AdminService */
    protected $adminService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
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

    public function logout()
    {
        return $this->adminService->logout();
    }
}
