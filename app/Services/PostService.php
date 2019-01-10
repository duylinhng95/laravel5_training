<?php

namespace App\Services;

use App\Repository\PostRepositoryEloquent;
use App\Repository\PostTagRepositoryEloquent;
use Auth;

class PostService
{
    protected $postRepository;
    protected $postTagRepository;

    public function __construct()
    {
        $this->postRepository = app(PostRepositoryEloquent::class);
        $this->postTagRepository = app(PostTagRepositoryEloquent::class);
    }

    public function all()
    {
        return $this->postRepository->all();
    }

    public function create($input)
    {
        $input['user_id'] = Auth::user()->id;
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

        return ['post' => $post, 'tags' => $tags];
    }

    public function delete($id)
    {
        return $this->postRepository->delete($id);
    }

    public function update($id, $input)
    {
        $this->postRepository->update($id, $input);
        $tags = explode(",", $input['tags']);
        foreach ($tags as $key => $tag) {
            $tags[$key] = ['name' => $tag];
        }
        unset($input['tags']);
        $this->postTagRepository->deleteTags($tags, $id);
        $this->postTagRepository->updateMany(['post_id' => $id], $tags);

        return ['code' => 202, 'message' => "Update Post Success"];
    }
}
