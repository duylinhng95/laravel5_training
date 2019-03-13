<?php

namespace App\Repository;

use App\Entities\Post;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use DB;

/**
 * @method withTrashed()
 */
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
        /** @var Post $post */
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

    /**
     * @param $id
     * @return array|int
     * @throws \Exception
     */
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

    public function getPosts($param)
    {
        $mainQuery = $this->makeModel()->where("status", "=", config('constant.post.status.available'));
        if (key_exists('keywords', $param) && $param['keywords']) {
            $keyword   = $param['keywords'];
            $mainQuery = $mainQuery->where(function ($query) use ($keyword) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('title', 'like', '%' . $keyword . '%');
            });
        }

        if (key_exists('tags', $param) && $param['tags']) {
            $keyword = $param['tags'];
            /** @var \Illuminate\Database\Eloquent\Builder $mainQuery */
            $mainQuery = $mainQuery->WhereHas('tags', function ($subQuery) use ($keyword) {
                /** @var Builder $subQuery */
                $subQuery->where('name', $keyword);
            });
        }

        if (key_exists('category', $param) && $param['category']) {
            $keyword   = $param['category'];
            $mainQuery = $mainQuery->WhereHas('category', function ($subQuery) use ($keyword) {
                /** @var Builder $subQuery */
                $subQuery->where('id', $keyword);
            });
        }

        if (key_exists('sort', $param) && $param['sort'] && $param['order']) {
            $section = $param['sort'];
            $order   = $param['order'];
            switch ($section) {
                case 'category':
                    $this->sortRelationship($mainQuery, $section, 'categories', $order);
                    break;
                case 'user':
                    $this->sortRelationship($mainQuery, $section, 'users', $order);
                    break;
                case 'comments':
                    $mainQuery = $mainQuery->withCount('comments')->orderBy('comments_count', $order);
                    break;
                default:
                    $mainQuery = $mainQuery->orderBy($section, $order);
            }
        }

        if (key_exists('filter', $param)) {
            $section = $param['filter'];
            $keys    = array_keys($section);
            foreach ($keys as $key) {
                $value     = $section[$key];
                $mainQuery = $mainQuery->whereHas($key, function ($subQuery) use ($value) {
                    /** @var Builder $subQuery */
                    $subQuery->whereIn('name', $value);
                });
            }
        }

        return $mainQuery->orderBy('created_at', 'desc')->paginate(10);
    }

    private function sortRelationship($query, $section, $childId, $order)
    {
        /** @var Builder $query */
        return $query = $query->select('posts.*')
            ->leftJoin($childId, $childId . '.id', 'posts.' . $section . '_id')
            ->orderBy('name', $order);
    }

    /**
     * @param $slug
     * @return array
     * @throws \Exception
     */
    public function destroy($slug)
    {
        /** @var Post $post */
        $post = $this->findWithTrashed($slug);

        try {
            DB::beginTransaction();
            $post->comments()->delete();
            $post->votes()->delete();
            $post->tags()->delete();
            $post->forceDelete();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }

        return ['code' => 200, 'message' => 'Delete Post Successful'];
    }

    public function findWithTrashed($slug)
    {
        return $this->makeModel()->withTrashed()->where('slug', $slug)->first();
    }

    /**
     * @param $param
     * @param $num
     * @return mixed
     */
    public function paginateWithTrashed($param, $num)
    {
        /** @var  $mainQuery */
        $mainQuery = $this->makeModel();

        if (key_exists('keywords', $param) && $param['keywords']) {
            $keyword   = $param['keywords'];
            $mainQuery = $mainQuery->where(function ($query) use ($keyword) {
                /** @var \Illuminate\Database\Eloquent\Builder $query */
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhereHas('tags', function ($subQuery) use ($keyword) {
                        /** @var Builder $subQuery */
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })->orWhereHas('category', function ($subQuery) use ($keyword) {
                        /** @var Builder $subQuery */
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    })->orWhereHas('user', function ($subQuery) use ($keyword) {
                        /** @var Builder $subQuery */
                        $subQuery->where('name', 'like', '%' . $keyword . '%');
                    });
            });
        }

        if (key_exists('sort', $param) && $param['sort'] && $param['order']) {
            $section = $param['sort'];
            $order   = $param['order'];
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

    public function restore($slug)
    {
        $post = $this->findWithTrashed($slug);
        return $post->restore();
    }

    public function getPopularPosts()
    {
        return $this->makeModel()->orderBy('view', 'desc')->limit(5)->get();
    }

    public function getLatestPost()
    {
        return $this->makeModel()->orderBy('created_at', 'desc')->limit(5)->get();
    }

    public function publish($slug)
    {
        $post         = $post = $this->findWithTrashed($slug);
        $post->status = config('constant.post.status.available');
        $post->save();
        return [true, 'Post Publish successful', $post];
    }

    public function getInterestPost($params)
    {
        $mainQuery = $this->makeModel();
        if (!$params) {
            $mainQuery = $mainQuery->orderByDesc('view');
        } else {
            $tags       = $params['tags'];
            $categories = $params['category'];

            $mainQuery = $mainQuery->whereHas('tags', function ($subQuery) use ($tags) {
                /** @var Builder $subQuery */
                $subQuery->whereIn('name', $tags);
            })->orWhereHas('category', function ($subQuery) use ($categories) {
                /** @var Builder $subQuery */
                $subQuery->whereIn('name', $categories);
            });
        }

        return $mainQuery->where('status', config('constant.post.available'))
            ->orderByDesc('created_at')
            ->limit(5)
            ->get();
    }
}
