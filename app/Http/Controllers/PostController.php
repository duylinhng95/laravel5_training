<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;

class PostController extends Controller
{
    use ResponseTrait;

    protected $postService;
    protected $categoryService;

    public function __construct()
    {
        $this->postService     = app(PostService::class);
        $this->categoryService = app(CategoryService::class);
    }

    public function index()
    {
        $posts      = $this->postService->all();
        $categories = $this->categoryService->all();
        return view('Post.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        list($post, $tags) = $this->postService->find($id);
        $this->postService->countView($post);
        return view('Post.detail', compact('post', 'tags'));
    }
}
