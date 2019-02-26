<?php

namespace App\Http\Controllers\Admin;

use App\Repository\PostRepository;
use App\Repository\PostRepositoryEloquent;
use Google\Cloud\Core\Exception\GoogleException;
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
        $this->adminService            = app(AdminService::class);
        $this->postService             = app(PostService::class);
        $this->postRepository          = app(PostRepository::class);
    }

    public function all(Request $request)
    {
        $params = $request->all();
        $posts  = $this->postRepository->paginateWithTrashed($params, 50);

        return view('Admin.post.index', compact('posts'));
    }

    public function show($slug)
    {
        list($post, $tags) = $this->postService->findWithTrashed($slug);

        return view('Admin.post.detail', compact('post', 'tags'));
    }

    /**
     * @param $slug
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function delete($slug)
    {
        $this->postRepository->destroy($slug);

        return redirect()->route('admin.post');
    }

    public function restore($slug)
    {
        $this->postRepository->restore($slug);

        return redirect()->route('admin.post.show', ['slug' => $slug]);
    }

    public function publishPost($slug)
    {
        try {
            $this->postService->publish($slug);
        } catch (GoogleException $e) {
            return $e->getMessage();
        }
        return redirect()->route('admin.post.show', ['slug' => $slug]);
    }
}
