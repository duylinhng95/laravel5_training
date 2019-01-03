<?php
namespace App\Repository;

use App\Entities\Post;
use App\Repository\PostRepository;
use App\Repository\BaseRepositoryEloquent;
use Illuminate\Http\Request;

class PostRepositoryEloquent extends BaseRepositoryEloquent implements PostRepository
{
    public function model(){
        return Post::class;
    }
}
