<?php

namespace App\Services;

use App\Repository\PostTagRepositoryEloquent;

class PostTagService
{
    protected $postTagRepository;

    public function __construct()
    {
        $this->postTagRepository = app(PostTagRepositoryEloquent::class);
    }

    public function createMany($array)
    {
        $this->postTagRepository->createMany($array);
    }
}
