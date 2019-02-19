<?php

namespace App\Repository;

use App\Entities\SexualContext;

class SexualContextRepositoryEloquent extends BaseRepositoryEloquent implements SexualContextRepository
{
    public function paginateBannedWords($keywords = '')
    {
        $query = $this->makeModel();
        if ($keywords != '') {
            $query = $query->where('context', 'like', '%' . $keywords . '%');
        }
        return $query->paginate(20);
    }
    public function getBannedWords()
    {
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
