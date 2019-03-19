<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use App\Repository\InterestRepository;
use App\Repository\InterestRepositoryEloquent;
use App\Services\UserService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;

class UserController extends Controller
{
    use ResponseTrait;
    /** @var UserService */
    protected $userService;
    /** @var InterestRepositoryEloquent */
    protected $interestRepository;

    public function __construct()
    {
        $this->userService        = app(UserService::class);
        $this->interestRepository = app(InterestRepository::class);
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

    public function setInterest(Request $request)
    {
        $userId = $request->get('user_id');
        $params = $request->except('user_id');
        list($status, $code, $message, $data) = $this->interestRepository->setInterest($userId, $params);
        if ($status) {
            return $this->success($message, $data);
        } else {
            return $this->error($code, $message, $data);
        }
    }

    public function getInterest(Request $request)
    {
        $userId = $request->get('user_id');
        list($status, $message, $data) = $this->interestRepository->getInterest($userId);
        if ($status) {
            return $this->success($message, $data);
        } else {
            return $this->response('true', 200, $message, $data);
        }
    }

    public function updateAvatar(Request $request)
    {
        $params = $request->all();
        list ($status, $message) = $this->userService->updateAvatar($params);
        if ($status) {
            return $this->success($message);
        }

        return $this->error(400, $message);
    }

    public function changeStatus(Request $request)
    {
        $id = $request->input('id');
        list($status, $code, $message, $data) = $this->userService->blockUser($id);
        if ($status) {
            return $this->success($message, $data);
        }
        return $this->error($code, $message);
    }

    public function getRegisterByDay()
    {
        list($status, $code, $message, $data) = $this->userService->getRegisterByDay();
        if ($status) {
            return $this->success($message, $data);
        }

        return $this->response(true, $code, $message, null);
    }
}
