<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(\App\Article::class, function (Faker $faker) {
    return [
        "title" => $faker->text(25),
        "body" => $faker->realText(),
        "visibility" => true,
    ];
});

$factory->state(\App\Article::class, 'visible', [
    'visibility' => true,
]);

$factory->state(\App\Article::class, 'hidden', [
    'visibility' => false,
]);
