<?php

namespace App\Http\Controllers\Admin;

use App\Repository\PostRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\PostService;

class PostController extends Controller
{
    /** @var  AdminService */
    protected $adminService;
    /** @var  PostService */
    protected $postService;
    /** @var PostRepository */
    protected $postRepository;

    public function __construct()
    {
        $this->adminService   = app(AdminService::class);
        $this->postService    = app(PostService::class);
        $this->postRepository = app(PostRepository::class);
    }

    public function all(Request $request)
    {
        $posts = $this->postRepository->paginateWithTrashed($request, 50);

        return view('Admin.post.index', compact('posts'));
    }

    public function show($id)
    {
        list($post, $tags) = $this->postService->findWithTrashed($id);

        return view('Admin.post.detail', compact('post', 'tags'));
    }

    public function delete($id)
    {
        $this->postRepository->destroy($id);

        return redirect()->route('admin.post');
    }

    public function restore($id)
    {
        $this->postRepository->restore($id);

        return redirect()->route('admin.show', ['id' => $id]);
    }
}
