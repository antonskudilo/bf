<?php

/** @var Factory $factory */

use App\Models\News;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(News::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(3),
        'body' => $faker->text(300),
        'status' => $faker->randomElement(['active', 'hidden', 'deleted']),
    ];
});
