<?php

namespace App\Repository;

use App\Repository\RocketProfileRepository;
use App\Repository\BaseRepositoryEloquent;
use App\Entities\RocketProfile;

class RocketProfileRepositoryEloquent extends BaseRepositoryEloquent implements RocketProfileRepository
{
    public function model()
    {
        return RocketProfile::class;
    }

    public function createProfile($arr)
    {
        foreach ($arr as $a) {
            $this->model->firstOrCreate($a);
        }
        return true;
    }
}
