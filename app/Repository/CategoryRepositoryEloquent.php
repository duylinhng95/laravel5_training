<?php

namespace App\Repository;

use App\Repository\BaseRepositoryEloquent;
use App\Entities\Category;

class CategoryRepositoryEloquent extends BaseRepositoryEloquent
{
    public function model()
    {
        return Category::class;
    }
}
