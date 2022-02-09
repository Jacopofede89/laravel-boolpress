<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'title' => $faker->words(3, true),
        'author' => $faker->name(),
        'description' => $faker->paragraph(1),
        'release_date' => $faker->date(),
        
    ];
});
