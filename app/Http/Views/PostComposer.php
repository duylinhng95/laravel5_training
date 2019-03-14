<?php

namespace App\Http\Views;

use App\Repository\CategoryRepository;
use App\Repository\CategoryRepositoryEloquent;
use App\Repository\PostRepositoryEloquent;
use App\Repository\PostTagRepository;
use App\Repository\PostRepository;
use App\Repository\PostTagRepositoryEloquent;
use Illuminate\View\View;

class PostComposer
{
    /** @var PostTagRepositoryEloquent */
    protected $postTagRepository;
    /** @var PostRepositoryEloquent */
    protected $postRepository;
    /** @var CategoryRepositoryEloquent */
    protected $categoryRepository;

    public function __construct()
    {
        $this->postRepository     = app(PostRepository::class);
        $this->postTagRepository  = app(PostTagRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function compose(View $view)
    {
        $tags       = $this->postTagRepository->getPopularTags();
        $posts      = $this->postRepository->getPopularPosts();
        $latestPost = $this->postRepository->getLatestPost();
        $categories = $this->categoryRepository->all();
        $view->with('posts', $posts);
        $view->with('latestPost', $latestPost);
        $view->with('tags', $tags);
        $view->with('categories', $categories);
    }
}
