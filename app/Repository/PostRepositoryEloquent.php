<?php

namespace App\Repository;

use App\Entities\Post;

class PostRepositoryEloquent extends BaseRepositoryEloquent implements PostRepository
{
    public function model()
    {
        return Post::class;
    }

    public function create($input)
    {
        $post = $this->makeModel()->create($input);
        $tags = $this->generateTagFromString($input);
        $post->tags()->createMany($tags);
        return ['code' => 200, 'message' => 'Create Post Successful'];
    }

    public function delete($id)
    {
        $post = $this->makeModel()->find($id);
        $post->delete();

        return ['code' => 200, 'message' => 'Delete Post Successful'];
    }

    public function update($id, $input, $att = 'id')
    {
        $post = $this->makeModel()->where($att, $id)->first();
        $tags = $this->generateTagFromString($input);
        $post->update($input);
        return $tags;
    }

    public function generateTagFromString($input)
    {
        $tags = explode(",", $input['tags']);
        foreach ($tags as $key => $tag) {
            $tags[$key] = ['name' => $tag];
        }
        unset($input['tags']);

        return $tags;
    }

    public function destroy($id)
    {
        $post = $this->makeModel()->find($id);
        $post->tags()->delete();
        $post->forceDelete();

        return ['code' => 200, 'message' => 'Delete Post Successful'];
    }

    public function paginateWithTrashed($num)
    {
        return $this->makeModel()->withTrashed()->paginate($num);
    }

    public function findWithTrashed($id)
    {
        return $this->makeModel()->withTrashed()->find($id);
    }

    public function restore($id)
    {
        return $this->makeModel()->withTrashed()->find($id)->restore();
    }
}
