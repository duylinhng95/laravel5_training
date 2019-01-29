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
        $row = $this->makeModel()->where('user_id', $userId)->where('follower_id', $followId)->get();
        if (count($row) === 0) {
            return $this->create([
                "user_id"     => $userId,
                "follower_id" => $followId,
            ]);
        } else {
            $this->deleteWhere(['user_id' => $userId, 'follower_id' => $followId]);
        }
    }
}
