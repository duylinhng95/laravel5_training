<?php

namespace App\Http\Controllers\API;

use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    use ResponseTrait;
    /** @var PostRepositoryEloquent */
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepository::class);
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
        $html = view('Post.Index.sidebar', compact('posts'))->render();
        return $this->success('Retrieve Post Success', ['view' => $html]);
    }
}
