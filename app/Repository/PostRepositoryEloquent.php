<?php

namespace App\Repository;

use App\Entities\Post;
use App\Entities\SexualContext;
use Illuminate\Database\Query\Builder;
use DB;

class PostRepositoryEloquent extends BaseRepositoryEloquent implements PostRepository
{
    public function model()
    {
        return Post::class;
    }

    public function create($input)
    {
        $tags = $this->generateTagFromString($input);
        unset($input['tags']);
        $post = $this->makeModel()->create($input);
        $post->tags()->createMany($tags);
        return ['code' => 200, 'message' => 'Create Post Successful', 'data' => $post];
    }

    public function generateTagFromString($input)
    {
        $tags = explode(",", $input['tags']);
        foreach ($tags as $key => $tag) {
            $tags[$key] = ['name' => $tag];
        }

        return $tags;
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
        unset($input['tags']);
        foreach ($tags as $tag) {
            $post->tags()->firstOrCreate($tag);
        }
        $post->update($input);
        return $tags;
    }

    public function getPosts($request)
    {
        $mainQuery = $this->makeModel()->where("status", "=", null);

        if ($request->has('keywords')) {
            $keyword   = $request->input('keywords');
            $mainQuery = $mainQuery->where(function ($query) use ($keyword) {
                /** @var Builder $query */
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('category', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })->orWhereHas('user', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($request->has('tags')) {
            $keyword   = $request->input('tags');
            $mainQuery = $mainQuery->WhereHas('tags', function ($subQuery) use ($keyword) {
                $subQuery->where('name', $keyword);
            });
        }

        if ($request->has('category')) {
            $keyword   = $request->input('category');
            $mainQuery = $mainQuery->WhereHas('category', function ($subQuery) use ($keyword) {
                $subQuery->where('id', $keyword);
            });
        }

        if ($request->has('sort')) {
            $section = $request->input('sort');
            $order   = $request->input('order');
            switch ($section) {
                case 'category':
                    $this->sortRelationship($mainQuery, $section, 'categories', $order);
                    break;
                case 'user':
                    $this->sortRelationship($mainQuery, $section, 'users', $order);
                    break;
                default:
                    $mainQuery = $mainQuery->orderBy($section, $order);
            }
        }

        return $mainQuery->orderBy('created_at', 'desc')->paginate(10);
    }

    private function sortRelationship($query, $section, $childId, $order)
    {
        return $query = $query->select('posts.*')
            ->leftJoin($childId, $childId . '.id', 'posts.' . $section . '_id')
            ->orderBy('name', $order);
    }

    public function destroy($id)
    {
        $post = $this->makeModel()->withTrashed()->find($id);
        try {
            DB::beginTransaction();
            $post->comments()->delete();
            $post->votes()->delete();
            $post->tags()->delete();
            $post->forceDelete();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
        DB::commit();
        return ['code' => 200, 'message' => 'Delete Post Successful'];
    }

    public function paginateWithTrashed($request, $num)
    {
        $mainQuery = $this->makeModel();

        if ($request->has('keywords')) {
            $keyword   = $request->input('keywords');
            $mainQuery = $mainQuery->where(function ($query) use ($keyword) {
                /** @var Builder $query */
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('tags', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })->orWhereHas('category', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })->orWhereHas('user', function ($subQuery) use ($keyword) {
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if ($request->has('sort')) {
            $section = $request->input('sort');
            $order   = $request->input('order');
            switch ($section) {
                case 'category':
                    $this->sortRelationship($mainQuery, $section, 'categories', $order);
                    break;
                case 'user':
                    $this->sortRelationship($mainQuery, $section, 'users', $order);
                    break;
                default:
                    $mainQuery = $mainQuery->orderBy($section, $order);
            }
        }
        return $mainQuery->orderBy('created_at', 'desc')->withTrashed()->paginate($num);
    }

    public function findWithTrashed($id)
    {
        return $this->makeModel()->withTrashed()->find($id);
    }

    public function restore($id)
    {
        return $this->makeModel()->withTrashed()->find($id)->restore();
    }

    public function getPopularPosts()
    {
        return $this->makeModel()->getPopularPost(5);
    }

    public function getLatestPost()
    {
        return $this->makeModel()->getLatestPost(5);
    }

    public function publish($id)
    {
        $post         = $this->makeModel()->find($id);
        $post->status = '';
        $post->save();
        return ['code' => 200, 'message' => 'Post Publish successful'];
    }
}
