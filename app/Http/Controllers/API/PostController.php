<?php

namespace App\Http\Controllers\API;

use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Services\PostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use ResponseTrait;
    /** @var PostRepositoryEloquent */
    protected $postRepository;
    /** @var PostService */
    protected $postService;

    public function __construct()
    {
        $this->postRepository = app(PostRepository::class);
        $this->postService    = app(PostService::class);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Throwable
     */
    public function getPost(Request $request)
    {
        $page     = $request->get('page');
        $posts    = $this->postRepository->getPosts($request->all());
        $lastPage = false;
        if ($page > $posts->lastPage()) {
            $lastPage = true;
        }
        $html = view('Post.Index.body', compact('posts'))->render();

        return $this->success('Retrieve Post Success', ['view' => $html, 'lastPage' => $lastPage]);
    }

    public function loadInterestPost(Request $request)
    {
        $posts = $this->postRepository->getInterestPost($request->all());
        try {
            $html = view('Post.Index.sidebar', compact('posts'))->render();
        } catch (\Throwable $e) {
            return $this->error($e->getCode(), 'Retrieve Post Failed', $e->getMessage());
        }
        return $this->success('Retrieve Post Success', ['view' => $html]);
    }

    public function browse(Request $request)
    {
        $params = $request->all();
        list($status, $code, $message, $data) = $this->postService->browsePosts($params);
        if ($status) {
            return $this->success($message, ['view' => $data], $code);
        } else {
            return $this->error($code, $message);
        }
    }

    public function getPostByDay()
    {
        list($status, $code, $message, $data) = $this->postService->getPostByDay();
        if ($status) {
            return $this->success($message, $data);
        }

        return $this->error($code, $message);
    }

    public function autocompleteKey(Request $request)
    {
        $params = $request->get('keyword');
        list($status, $message, $data) = $this->postService->getAutocompleteData($params);
        if ($status) {
            return $this->success('Retrieve hints success', $data);
        }
        return $this->success($message, null);
    }
}
