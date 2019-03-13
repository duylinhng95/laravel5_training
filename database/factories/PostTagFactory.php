<?php

use Faker\Generator as Faker;

$factory->define(App\Entities\PostTag::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'post_id' => function () {
            return App\Entities\Post::inRandomOrder()->first()->id;
        }
    ];
});
