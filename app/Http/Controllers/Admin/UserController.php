<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RegisterRequest;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryEloquent;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;

    /** @var $adminService AdminService */
    protected $adminService;
    /** @var $userRepository UserRepositoryEloquent */
    protected $userRepository;
    /** @var UserService */
    protected $userService;

    public function __construct()
    {
        $this->adminService   = app(AdminService::class);
        $this->userRepository = app(UserRepository::class);
        $this->userService    = app(UserService::class);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function import()
    {
        $this->adminService->importUserDB();
        return $this->success('Import User Successful');
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

    public function index(Request $request)
    {
        $params = $request->all();
        $users  = $this->userRepository->getUsers($params);
        return view('Admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('Admin.user.create');
    }

    //Change Request to RegisterRequest
    public function store(RegisterRequest $request)
    {
        $params = $request->except('_token');
        $user   = $this->userService->createUser($params);
        return redirect()->route('admin.user')->with('success', "Add User Successfully");
    }
}
