<?php

namespace App\Repository;

use App\Entities\PostTag;

class PostTagRepositoryEloquent extends BaseRepositoryEloquent implements PostTagRepository
{
    public function model()
    {
        return PostTag::class;
    }

    /**
     * @param $array
     * @param $id
     * @return bool|int|null
     * @throws \Exception
     */
    public function deleteTags($array, $id)
    {
        return $this->makeModel()->where('post_id', $id)->whereNotIn('name', $array)->delete();
    }

    public function updateMany($id, $array)
    {
        $result = [];
        foreach ($array as $data) {
            $result[] = $this->makeModel()->firstOrCreate($data, $id);
        }
        return $result;
    }

    public function getPopularTags()
    {
        return $this->makeModel()->popular_tags;
    }

    public function getTags($page = null)
    {
        return $this->makeModel()
            ->join('posts', 'posts.id', '=', 'post_tags.post_id')
            ->where('status', config('constant.post.status.available'))
            ->paginate(5);
    }
}
