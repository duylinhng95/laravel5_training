<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        $posts = $this->postService->listByUser();
        return view('Post.list', compact('posts'));
    }

    public function show($id)
    {
        list($post, $tags) = $this->postService->find($id);
        return view('Post.detail', compact('post', 'tags'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('Post.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $input = $request->except('_token');
        $this->postService->create($input);
        return redirect('/user/post');
    }

    public function edit($id)
    {
        list($post, $tags) = $this->postService->find($id);
        $categories = $this->categoryService->all();
        return view('Post.edit', compact('post', 'categories', 'tags'));
    }

    public function update($id, Request $request)
    {
        $input            = $request->except('_method', '_token');
        $input['content'] = $this->convertImg($input['content']);
        $this->postService->update($id, $input);
        return redirect('user/post');
    }

    public function destroy($id)
    {
        $response = $this->postService->delete($id);
        return $this->responseObject($response);
    }
}
