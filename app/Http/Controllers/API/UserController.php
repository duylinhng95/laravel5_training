<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Services\UserService;
use App\Traits\ResponseTrait;

class UserController extends Controller
{
    use ResponseTrait;
    /** @var UserService */
    protected $userService;

    public function __construct()
    {
        $this->userService = app(UserService::class);
    }

    public function register(RegisterRequest $request)
    {
        return $this->success('Input is valid');
    }

    public function login(LoginRequest $request)
    {
        $input = $request->except('_token');
        list($status, $code, $message) = $this->userService->checkLogin($input);
        if ($status) {
            return $this->success('Input is valid');
        } else {
            return $this->error($code, $message);
        }
    }
}
