<?php

namespace App\Http\Controllers\Admin;

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
        $params = $request->all();
        $posts  = $this->postRepository->paginateWithTrashed($params, 50);

        return view('Admin.post.index', compact('posts'));
    }

    public function show($id)
    {
        list($post, $tags) = $this->postService->findWithTrashed($id);

        return view('Admin.post.detail', compact('post', 'tags'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
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

    public function publishPost($id)
    {
        $this->postRepository->publish($id);
        return redirect()->route('admin.post.show', ['id' => $id]);
    }
}
