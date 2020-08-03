<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;


$factory->define(Category::class, function (Faker $faker) {


    return [
        'name' => $faker->words($nb = 1, $asText = true),
        'parent_id' => null,
        'description' => $faker->text(200),
        'published' => $faker->boolean(),
    ];
});
