<?php

namespace App\Repository;

use App\Entities\SexualContext;

class SexualContextRepositoryEloquent extends BaseRepositoryEloquent implements SexualContextRepository
{
    public function getBannedWords($keywords = '')
    {
        if ($keywords != '') {
            return $this->makeModel()->where('context', 'like', '%' . $keywords . '%')->get();
        }
        return $this->makeModel()->all();
    }

    public function createBannedWords($data)
    {
        return $this->makeModel()->firstOrCreate($data);
    }

    public function model()
    {
        return SexualContext::class;
    }
}
