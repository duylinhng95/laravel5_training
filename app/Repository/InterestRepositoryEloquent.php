<?php

namespace App\Repository;

use App\Entities\Interest;

class InterestRepositoryEloquent extends BaseRepositoryEloquent implements InterestRepository
{
    public function model()
    {
        return Interest::class;
    }

    public function setInterest($userId, $params)
    {
        $tags       = $params['tags'];
        $categories = $params['categories'];
        if (is_array($tags)) {
            $params['tags'] = implode(', ', $tags);
        }

        if (is_array($categories)) {
            $params['categories'] = implode(', ', $categories);
        }
        $res = $this->makeModel()->updateOrCreate(['user_id' => $userId], $params);

        return [true, 200, 'Update/Create Interest successfully', $res];
    }
}
