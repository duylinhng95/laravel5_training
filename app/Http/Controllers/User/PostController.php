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

    public function show($slug)
    {
        list($post, $tags, $comments, $followed) = $this->postService->findBySlug($slug);

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
        list($status, $message) = $this->postService->create($input);
        if ($status) {
            return redirect()->route('user.post.index');
        } else {
            return back()->withErrors($message);
        }
    }

    public function edit($slug)
    {
        list($post, $tags) = $this->postService->find($slug);
        $categories = $this->categoryRepository->all();

        return view('Post.User.edit', compact('post', 'categories', 'tags'));
    }

    public function update($slug, PostRequest $request)
    {
        $input = $request->except('_method', '_token');
        try {
            list($status, $message) = $this->postService->update($slug, $input);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
        if ($status) {
            return redirect()->route('user.post.index');
        } else {
            return back()->withErrors($message);
        }
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
    public function destroy($slug)
    {
        $post = $this->postRepository->findWhereGetFirst(['slug' => $slug]);
        $id = $post->id;
        $this->postRepository->delete($id);

        return $this->success('Delete Post Successful');
    }
}
