<?php

namespace App\Services;

use App\Repository\PostTagRepository;

class PostTagService
{
    protected $postTagRepository;

    public function __construct()
    {
        $this->postTagRepository = app(PostTagRepository::class);
    }

    public function createMany($array)
    {
        $this->postTagRepository->createMany($array);
    }

    public function all()
    {
        return $this->postTagRepository->paginate(15);
    }
}
