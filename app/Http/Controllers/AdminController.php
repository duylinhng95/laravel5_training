<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
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

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->adminService   = app(AdminService::class);
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
        return redirect()->route('admin.user');
    }
}
