<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryEloquent;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Services\PostService;
use App\Services\CategoryService;
use App\Traits\ResponseTrait;
use App\Http\Requests\PostRequest;

class PostController extends Controller
{
    use ResponseTrait;

    /** @var PostService */
    protected $postService;
    /** @var CategoryService */
    protected $categoryService;
    /** @var CategoryRepositoryEloquent */
    protected $categoryRepository;
    /** @var PostRepositoryEloquent */
    protected $postRepository;

    public function __construct()
    {
        $this->postService        = app(PostService::class);
        $this->postRepository     = app(PostRepository::class);
        $this->categoryService    = app(CategoryService::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function index()
    {
        $posts = $this->postService->listByUser();

        return view('Post.list', compact('posts'));
    }

    public function show($id)
    {
        list($post, $tags, $comments, $followed) = $this->postService->find($id);

        return view('Post.detail', compact('post', 'tags', 'comments', 'followed'));
    }

    public function create()
    {
        $categories = $this->categoryRepository->all();

        return view('Post.User.create', compact('categories'));
    }

    public function store(PostRequest $request)
    {
        $input = $request->except('_token');
        $this->postService->create($input);

        return redirect()->route('user.post.index');
    }

    public function edit($id)
    {
        list($post, $tags) = $this->postService->find($id);
        $categories = $this->categoryRepository->all();

        return view('Post.User.edit', compact('post', 'categories', 'tags'));
    }

    public function update($id, PostRequest $request)
    {
        $input = $request->except('_method', '_token');
        $this->postService->update($id, $input);

        return redirect()->route('user.post.index');
    }

    public function destroy($id)
    {
        $this->postRepository->delete($id);

        return $this->success('Delete Post Successful');
    }
}
