<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->text(50),
        'description' => $faker->text(500),
        'thumbnail' => null,
        'gallery' => null,
        'publish_from' => $faker->dateTimeBetween('-14 days', '-7 days'),
        'publish_to' => $faker->dateTimeBetween('+5 days', '+14 days'),
        'published' => $faker->boolean(),
    ];
});
