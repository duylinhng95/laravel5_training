<?php

namespace App\Services;

use App\Repository\PostRepositoryEloquent;

class PostService
{
    protected $postRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepositoryEloquent::class);
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function create($input)
    {
        return $this->postRepository->create($input);
    }
}
