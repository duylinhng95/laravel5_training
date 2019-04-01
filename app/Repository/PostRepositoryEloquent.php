<?php

namespace App\Repository;

use App\Entities\Post;
use App\Repository\PostRepository;
use App\Repository\BaseRepositoryEloquent;
use Auth;

class PostRepositoryEloquent extends BaseRepositoryEloquent implements PostRepository
{
    public function model()
    {
        return Post::class;
    }

    public function create($input)
    {
        $tags = explode(",", $input['tags']);
        foreach ($tags as $k => $t) {
            $tags[$k] = ['name' => $t];
        }
        unset($input['tags']);
        $input['user_id'] = Auth::user()->id;
        $post             = $this->makeModel()->create($input);
        $post->tags()->createMany($tags);

        return ['code' => 200, 'message' => 'Create Post Successful'];
    }
}
