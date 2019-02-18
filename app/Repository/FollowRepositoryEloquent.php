<?php

namespace App\Repository;

use App\Entities\Follow;

class FollowRepositoryEloquent extends BaseRepositoryEloquent implements FollowRepository
{
    public function model()
    {
        return Follow::class;
    }

    public function follow($followerId, $userId)
    {
        $row = $this->makeModel()->where('user_id', $userId)->where('follower_id', $followerId)->get();
        if (count($row) === 0) {
            $this->create([
                "user_id"     => $userId,
                "follower_id" => $followerId,
            ]);

            return [$userId, $followerId];
        } else {
            $this->deleteWhere(['user_id' => $userId, 'follower_id' => $followerId]);

            return [$userId, $followerId];
        }
    }
}
