<?php

namespace App\Services;

use App\Repository\PostRepository;
use App\Repository\PostTagRepository;
use Auth;
use App\Traits\SummernoteTrait;

class PostService
{
    use SummernoteTrait;

    protected $postRepository;
    protected $postTagRepository;

    public function __construct()
    {
        $this->postRepository    = app(PostRepository::class);
        $this->postTagRepository = app(PostTagRepository::class);
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function create($input)
    {
        $input['user_id'] = Auth::user()->id;
        $input['content'] = $this->convertImg($input['content']);
        return $this->postRepository->create($input);
    }

    public function listByUser()
    {
        $userId = Auth::user()->id;
        return $this->postRepository->findByFields('user_id', $userId);
    }

    public function find($id)
    {
        $post = $this->postRepository->find($id);
        $tags = implode(',', $post->tags->pluck('name')->toArray());
        return [$post, $tags];
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }

    public function update($id, $input)
    {
        $input['content'] = $this->convertImg($input['content']);
        $this->postRepository->update($id, $input);
        $tags = $this->postRepository->generateTagFromString($input);
        $this->postTagRepository->deleteTags($tags, $id);
        $this->postTagRepository->updateMany(['post_id' => $id], $tags);
        return ['code' => 202, 'message' => "Update Post Success"];
    }

    public function paginate($num)
    {
        return $this->postRepository->paginate($num);
    }
}
