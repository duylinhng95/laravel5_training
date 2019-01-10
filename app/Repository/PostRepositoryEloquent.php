<?php

namespace App\Repository;

use App\Entities\Post;
use App\Repository\PostRepository;
use App\Repository\BaseRepositoryEloquent;

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
        $post = $this->makeModel()->create($input);
        $post->tags()->createMany($tags);

        return ['code' => 200, 'message' => 'Create Post Successful'];
    }

    public function delete($id)
    {
        $post = $this->makeModel()->find($id);
        $post->tags()->delete();
        $post->delete();

        return ['code' => 200, 'message' => 'Delete Post Successful'];
    }

    public function update($id, $input, $att = 'id')
    {
        $post = $this->makeModel()->where($att, $id)->first();
        $post->update($input);

        return ['code' => 200, 'message' => 'Edit Post Successful'];
    }
}
