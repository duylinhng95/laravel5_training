<?php

namespace App\Http\Controllers;

use App\Repository\PostTagRepository;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Auth;

class PostController extends Controller
{
    use ResponseTrait;

    protected $postService;
    protected $categoryService;
    protected $postTagService;

    public function __construct()
    {
        $this->postService     = app(PostService::class);
        $this->categoryService = app(CategoryService::class);
        $this->postTagService  = app(PostTagRepository::class);
    }

    public function index(Request $request)
    {
        $posts      = $this->postService->all();
        $categories = $this->categoryService->all();
        $tags       = $this->postTagService->all();
        if ($request->has('keyword')) {
            $posts = $this->postService->search($request->input('keyword'));
        }
        return view('Post.index', compact('posts', 'categories', 'tags'));
    }

    public function show($id)
    {
        list($post, $tags, $comments, $followed) = $this->postService->find($id);
        if (Auth::user()->id == $post->user->id) {
            return redirect('/user/post/' . $id);
        }
        $this->postService->countView($post);
        return view('Post.detail', compact('post', 'tags', 'comments', 'followed'));
    }

    public function comment($postId, Request $request)
    {
        $input   = $request->except('_token');
        $comment = $this->postService->comment($postId, $input);
        return $this->json($this->success('Add new comment successful', $comment));
    }

    public function vote($postId)
    {
        return $this->postService->vote($postId);
    }
}
