<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use App\Services\AdminService;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;

class AdminController extends Controller
{
    /** @var UserRepository */
    protected $userRepository;
    protected $adminService;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
        $this->adminService   = app(AdminService::class);
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getUsers($request);
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
}
