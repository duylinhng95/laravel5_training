<?php

namespace App\Repository;

use App\Repository\BaseRepositoryEloquent;
use App\Entities\PostTag;

class PostTagRepositoryEloquent extends BaseRepositoryEloquent
{
    public function model()
    {
        return PostTag::class;
    }

    public function deleteTags($array, $id)
    {
        return $this->makeModel()->where('post_id', $id)->whereNotIn('name', $array)->delete();
    }

    public function updateMany($id, $array)
    {
        foreach ($array as $data) {
            $result[] = $this->makeModel()->firstOrCreate($data, $id);
        }
        return $result;
    }
}
