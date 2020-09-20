<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'position' => $faker->text,
        'image' => $faker->image('public/images',400,300),
        'pto' => $faker->randomNumber(),
        'points'=> $faker->randomNumber()
    ];
});
