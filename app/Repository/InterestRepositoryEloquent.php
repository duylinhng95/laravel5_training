<?php

namespace App\Repository;

use App\Entities\Interest;

class InterestRepositoryEloquent extends BaseRepositoryEloquent implements InterestRepository
{
    public function model()
    {
        return Interest::class;
    }
}
