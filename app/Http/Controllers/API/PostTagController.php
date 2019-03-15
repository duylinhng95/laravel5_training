<?php

namespace App\Http\Controllers\API;

use App\Services\PostTagService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ResponseTrait;

class PostTagController extends Controller
{
    use ResponseTrait;
    /** @var PostTagService */
    protected $postTagService;

    public function __construct()
    {
        $this->postTagService = app(PostTagService::class);
    }

    public function getTags(Request $request)
    {
        list($status, $code, $message, $data) = $this->postTagService->getTags($request->all());
        if ($status) {
            return $this->success($message, $data);
        }

        return $this->error($code, $message);
    }
}
