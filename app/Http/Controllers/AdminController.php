<?php

namespace App\Http\Controllers;

use App\Repository\UserRepository;
use Illuminate\Http\Request;
use App\Traits\ResponseTrait;

class AdminController extends Controller
{
    use ResponseTrait;
    /** @var UserRepository */
    protected $userRepository;

    public function __construct()
    {
        $this->userRepository = app(UserRepository::class);
    }

    public function index(Request $request)
    {
        $users = $this->userRepository->getUsers($request);
        return view('Admin.user.index', compact('users'));
    }
}
