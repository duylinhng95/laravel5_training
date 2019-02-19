<?php

namespace App\Http\Controllers;

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
        $posts      = $this->postRepository->getPosts($request);
        $categories = $this->categoryRepository->all();

        return view('Post.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        list($post, $tags, $comments, $followed) = $this->postService->find($id);
        if (Auth::check()) {
            $userId = Auth::id();
            if ($post->checkOwner($userId)) {
                return redirect()->route('user.post.show', ['id' => $id]);
            }
        }
        $this->postService->countView($post);

        return view('Post.detail', compact('post', 'tags', 'comments', 'followed'));
    }

    public function comment($postId, Request $request)
    {
        $input = $request->except('_token');
        if (is_null($input['content'])) {
            return $this->error(400, "The comment is empty");
        }
        $comment = $this->postService->comment($postId, $input);

        return $this->success('Add new comment successful', $comment);
    }

    public function vote($postId)
    {
        return $this->postService->vote($postId);
    }
}
