<?php

namespace App\Repository;

use App\Entities\Post;
use Illuminate\Database\Query\Builder;

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

    public function generateTagFromString($input)
    {
        $tags = explode(",", $input['tags']);
        foreach ($tags as $key => $tag) {
            $tags[$key] = ['name' => $tag];
        }
        unset($input['tags']);

        return $tags;
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
        $tags = $this->generateTagFromString($input);
        $post->update($input);
        return $tags;
    }

    public function search($keyword)
    {
        return $this->model->where(function ($query) use ($keyword) {
            /** @var Builder $query, $subQuery */
            $query->where('title', 'like', '%' . $keyword . '%')
                ->orWhereHas('tags', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                })->orWhereHas('category', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                })->orWhereHas('user', function ($subQuery) use ($keyword) {
                    $subQuery->where('name', 'like', '%' . $keyword . '%');
                });
        })->paginate(50);
    }

    public function all()
    {
        return $this->makeModel()->orderBy('created_at', 'des')->paginate(10);
    }
}
