<?php

namespace App\Http\Controllers\Admin;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    /** @var $adminService AdminService */
    protected $adminService;
    /** @var $userRepository UserRepository */
    protected $userRepository;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
        $this->userRepository = app(UserRepository::class);
    }

    public function import()
    {
        $this->adminService->importUserDB();
//        return $this->success('Import User Successful');
    }

    public function block(Request $request)
    {
        $id   = $request->input('id');
        $user = $this->userRepository->blocked($id);
        return $this->success('Block User Successful', $user);
    }

    public function unblock(Request $request)
    {
        $id   = $request->input('id');
        $user = $this->userRepository->unblocked($id);
        return $this->success('Unblock User Successful', $user);
    }
}
