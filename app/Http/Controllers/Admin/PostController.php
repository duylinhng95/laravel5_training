<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\AdminService;
use App\Services\PostService;

class PostController extends Controller
{
    protected $adminService;
    protected $postService;

    public function __construct()
    {
        $this->adminService = app(AdminService::class);
        $this->postService  = app(PostService::class);
    }

    public function all(Request $request)
    {

        $posts = $this->postService->paginateWithTrashed(50);
        if ($request->has('keywords')) {
            $posts = $this->postService->search($request->input('keywords'));
        }
        return view('Admin.post.index', compact('posts'));
    }

    public function show($id)
    {
        list($post, $tags) = $this->postService->findWithTrashed($id);
        return view('Admin.post.detail', compact('post', 'tags', 'user'));
    }

    public function delete($id)
    {
        return $this->postService->deleteNorTags($id);
    }

    public function restore($id)
    {
        $this->postService->restorePost($id);
        return redirect('/admin/post/' . $id);
    }
}
