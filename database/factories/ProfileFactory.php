<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'avatar' => $faker->image(storage_path('app/images'),400,300, null, false),
        'pto' => $faker->randomNumber(2),
        'points'=> $faker->randomNumber(2),
        'user_id'=> 1,
        'pto_usage'=> $faker->randomElements([10,3,8,5,6,7,10,16,11,7,9,1]),
        'points_usage'=> $faker->randomElements([10,3,8,5,6,7,10,16,11,7,9,1])
    ];
});
