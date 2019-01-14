<?php

namespace App\Repository;

use App\Entities\Follow;

class FollowRepositoryEloquent extends BaseRepositoryEloquent implements FollowRepository
{
    public function model()
    {
        return Follow::class;
    }

    public function follow($followId, $userId)
    {
        return $this->makeModel()->create([
            "user_id"     => $userId,
            "follower_id" => $followId,
        ]);
    }

    public function unfollow($followId, $userId)
    {
        $follow = $this->deleteWhere(['user_id' => $userId, 'follower_id' => $followId]);
        return $follow;
    }
}
