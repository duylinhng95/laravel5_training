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
        'status' => null,
    ];
});
