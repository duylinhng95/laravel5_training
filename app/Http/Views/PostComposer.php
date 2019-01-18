<?php

namespace App\Http\Views;

use App\Repository\PostTagRepository;
use App\Repository\PostRepository;
use Illuminate\View\View;

class PostComposer
{
    protected $postTagRepository;
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository    = app(PostRepository::class);
        $this->postTagRepository = app(PostTagRepository::class);
    }

    public function compose(View $view)
    {
        $tags  = $this->postTagRepository->getPopularTags();
        $posts = $this->postRepository->all();
        $view->with('posts', $posts);
        $view->with('tags', $tags);
    }
}
