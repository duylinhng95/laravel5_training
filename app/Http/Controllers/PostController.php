<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CategoryService;

class PostController extends Controller
{
    protected $postService;
    protected $categorySerivice;

    public function __construct()
    {
        $this->postService     = app(PostService::class);
        $this->categoryService = app(CategoryService::class);
    }

    public function index()
    {
        $posts      = $this->postService->all();
        $categories = $this->categoryService->all();
        return view('Post/index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = $this->postRepository->find($id);
        return $post;
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('Post/create', compact('categories'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $this->postService->create($input);
        return redirect('/post');
    }

    public function edit($id)
    {
        $post = $this->postRepository->find($id);
        return view('Post/edit', compact('post'));
    }

    public function update($id, Request $request)
    {
        $input = $request->except('_method', '_token');
        $this->postRepository->update($id, $input);
        return redirect('/post');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);
    }
}
