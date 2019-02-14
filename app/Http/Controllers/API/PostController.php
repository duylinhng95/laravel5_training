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

    public function getPost(Request $request)
    {
        $page  = $request->get('page');
        $posts = $this->postRepository->paginate(10);
        if ($page > $posts->lastPage()) {
            return $this->error(400, 'Page not found', $posts->lastPage());
        }
        $html = view('Post.Index.body', compact('posts'))->render();

        return $this->success('Retrieve Post Success', $html);
    }
}
