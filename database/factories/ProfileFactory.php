<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'position' => $faker->text,
        'avatar' => $faker->image(storage_path('app/images'),400,300, null, false),
        'pto' => $faker->randomNumber(2),
        'points'=> $faker->randomNumber(2),
        'user_id'=> 1,
    ];
});
