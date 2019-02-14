<?php

use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = factory(App\Entities\Post::class, 50)
            ->create()
            ->each(function ($post) {
                $post->tags()->save(factory(App\Entities\PostTag::class)->make());
            });
    }
}
