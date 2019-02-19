<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\BannedWordsRequest;
use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use App\Repository\SexualContextRepository;
use App\Repository\SexualContextRepositoryEloquent;
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
    /** @var SexualContextRepositoryEloquent */
    protected $sexualContextRepository;

    public function __construct()
    {
        $this->adminService            = app(AdminService::class);
        $this->postService             = app(PostService::class);
        $this->postRepository          = app(PostRepository::class);
        $this->sexualContextRepository = app(SexualContextRepository::class);
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

    public function showBannedWords(Request $request)
    {
        if ($request->has('keywords')) {
            $words = $this->sexualContextRepository->getBannedWords(($request->input('keywords')));
        } else {
            $words = $this->sexualContextRepository->getBannedWords();
        }
        return view('Admin.post.banned', compact('words'));
    }

    public function uploadBannedWords(BannedWordsRequest $request)
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

    public function publishPost($id)
    {
        $this->postRepository->publish($id);
        return redirect()->route('admin.post.show', ['id' => $id]);
    }
}
