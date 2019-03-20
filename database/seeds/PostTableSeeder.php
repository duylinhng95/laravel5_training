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
        DB::table('posts')->truncate();

        $posts = factory(App\Entities\Post::class, 20000)
            ->create()
            ->each(function ($post) {
                $post->tags()->save(factory(App\Entities\PostTag::class)->make());
            });
    }
}
