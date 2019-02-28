<?php

namespace App\Http\Controllers;

use App\Entities\Post;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryEloquent;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Services\PostService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    use ResponseTrait;
    /** @var PostService */
    protected $postService;
    /** @var PostRepositoryEloquent */
    protected $postRepository;
    /** @var CategoryRepositoryEloquent */
    protected $categoryRepository;

    public function __construct()
    {
        $this->postService        = app(PostService::class);
        $this->postRepository     = app(PostRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index(Request $request)
    {
        $params     = $request->all();
        $posts      = $this->postRepository->getPosts($params);
        $categories = $this->categoryRepository->all();

        return view('Post.index', compact('posts', 'categories'));
    }

    public function show($slug)
    {
        list($post, $tags, $comments, $followed) = $this->postService->findBySlug($slug);
        if ($post->status != config('constant.post.status.available')) {
            return redirect()->route('post.index');
        }
        if (Auth::check()) {
            $userId = Auth::id();
            /** @var Post $post */
            if ($post->checkOwner($userId)) {
                return redirect()->route('user.post.show', ['slug' => $slug]);
            }
        }
        $this->postService->countView($post);

        return view('Post.detail', compact('post', 'tags', 'comments', 'followed'));
    }

    public function comment($slug, Request $request)
    {
        $input = $request->except('_token');
        if (is_null($input['content'])) {
            return $this->error(400, "The comment is empty");
        }
        $comment = $this->postService->comment($slug, $input);

        return $this->success('Add new comment successful', $comment);
    }

    public function vote($slug)
    {
        return $this->postService->vote($slug);
    }
}
