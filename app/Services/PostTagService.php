<?php

namespace App\Services;

use App\Repository\PostTagRepository;
use App\Repository\PostTagRepositoryEloquent;

class PostTagService
{
    /** @var PostTagRepositoryEloquent */
    protected $postTagRepository;

    public function __construct()
    {
        $this->postTagRepository = app(PostTagRepository::class);
    }

    public function getTags($params)
    {
        $tags = $this->postTagRepository->getTags($params);
        try {
            $html = view('Post.partial.tags', compact('tags'))->render();
        } catch (\Throwable $e) {
            return [false, $e->getCode(), $e->getMessage(), null];
        }

        return [true, 200, 'Get tags successful', ['view' => $html]];
    }
}
