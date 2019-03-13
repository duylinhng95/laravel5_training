<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\Post::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(),
        'content' => $faker->paragraph(250),
        'user_id' => function () {
            return App\Entities\User::inRandomOrder()->first()->id;
        },
        'category_id' => function () {
            return App\Entities\Category::inRandomOrder()->first()->id;
        },
        'status' => config('constant.post.status.available'),
        'created_at' => $faker->dateTime(),
    ];
});

$factory->afterCreating(App\Entities\Post::class, function ($post, $faker) {
    $post->slug = str_slug($post->title. '-');
    $post->save();
});
