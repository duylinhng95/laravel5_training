<?php

namespace App\Providers;

use App\Repository\CommentRepositoryEloquent;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\FollowRepository;
use App\Repository\FollowRepositoryEloquent;
use App\Repository\PostTagRepository;
use App\Repository\PostVoteRepository;
use App\Repository\PostVoteRepositoryEloquent;
use App\Repository\UserRepository;
use App\Repository\AdminRepository;
use App\Repository\RocketProfileRepository;
use App\Repository\PostTagRepositoryEloquent;
use App\Repository\AdminRepositoryEloquent;
use App\Repository\RocketProfileRepositoryEloquent;
use App\Repository\PostRepositoryEloquent;
use App\Repository\UserRepositoryEloquent;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PostRepository::class, PostRepositoryEloquent::class);
        $this->app->bind(UserRepository::class, UserRepositoryEloquent::class);
        $this->app->bind(PostTagRepository::class, PostTagRepositoryEloquent::class);
        $this->app->bind(AdminRepository::class, AdminRepositoryEloquent::class);
        $this->app->bind(RocketProfileRepository::class, RocketProfileRepositoryEloquent::class);
        $this->app->bind(CommentRepository::class, CommentRepositoryEloquent::class);
        $this->app->bind(FollowRepository::class, FollowRepositoryEloquent::class);
        $this->app->bind(PostVoteRepository::class, PostVoteRepositoryEloquent::class);
    }
}
