<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Traits\SummernoteTrait;

class PostController extends Controller
{
    use SummernoteTrait;

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
        $post = $this->postService->find($id);
        return view('Post/detail', compact('post'));
    }

    public function create()
    {
        $categories = $this->categoryService->all();
        return view('Post/create', compact('categories'));
    }

    public function store(Request $request)
    {
        $input  = $request->except('_token');
        $input['content'] = $this->convertImg($input['content']);
        $this->postService->create($input);
        return redirect('/user/post');
    }

    public function edit($id)
    {
        $post       = $this->postService->find($id);
        $categories = $this->categoryService->all();
        return view('Post/edit', compact('post', 'categories'));
    }

    public function update($id, Request $request)
    {
        $input = $request->except('_method', '_token');
        $input['content'] = $this->convertImg($input['content']);
        $this->postService->update($id, $input);
        return redirect('user/post');
    }

    public function destroy($id)
    {
        return response()->json($this->postService->delete($id));
    }

    public function list()
    {
        $posts = $this->postService->listByUser();
        return view('Post.list', compact('posts'));
    }
}
