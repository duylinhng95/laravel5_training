<?php

namespace App\Http\Controllers\Admin;

use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
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
    /** @var PostRepositoryEloquent */
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

        return redirect()->route('admin.post.show', ['id' => $id]);
    }

    public function showBannedWords()
    {
        $words = $this->postRepository->getBannedWords();
        return view('Admin.post.banned', compact('words'));
    }

    public function uploadBannedWords(Request $request)
    {
        $status = false;
        if ($request->hasFile('banned_words')) {
            $file = $request->file('banned_words')->getRealPath();
            list($status, $message) = $this->postService->uploadBannedWords($file);
        }
        if ($status) {
            return redirect()->route('admin.post.words');
        }
    }
}
