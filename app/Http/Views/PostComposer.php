<?php

namespace App\Http\Views;

use App\Repository\CategoryRepository;
use App\Repository\PostTagRepository;
use App\Repository\PostRepository;
use Illuminate\View\View;

class PostComposer
{
    protected $postTagRepository;
    protected $postRepository;
    protected $categoryRepository;

    public function __construct()
    {
        $this->postRepository     = app(PostRepository::class);
        $this->postTagRepository  = app(PostTagRepository::class);
        $this->categoryRepository = app(CategoryRepository::class);
    }

    public function compose(View $view)
    {
        $tags     = $this->postTagRepository->getPopularTags();
        $posts    = $this->postRepository->getPopularPosts();
        $categories = $this->categoryRepository->all();
        $view->with('posts', $posts);
        $view->with('tags', $tags);
        $view->with('categories', $categories);
    }
}
