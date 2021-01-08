<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Profile;
use App\User;
use Faker\Generator as Faker;

$factory->define(Profile::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class),
        'position' => $faker->word,
        'pto' => $faker->numberBetween($min =0, $max = 40),
        'points'=> $faker->numberBetween($min =0, $max = 15),
        'pto_usage'=>  [
            'Jan' => $faker->numberBetween($min =0, $max = 5),
            'Feb' => $faker->numberBetween($min =0, $max = 5),
            'Mar' => $faker->numberBetween($min =0, $max = 5),
            'Apr' => $faker->numberBetween($min =0, $max = 5),
            'May' => $faker->numberBetween($min =0, $max = 5),
            'Jun' => $faker->numberBetween($min =0, $max = 5),
            'July' => $faker->numberBetween($min =0, $max = 5),
            'Aug' => $faker->numberBetween($min =0, $max = 5),
            'Sept' => $faker->numberBetween($min =0, $max = 5),
            'Nov' => $faker->numberBetween($min =0, $max = 5),
            'Dec' => $faker->numberBetween($min =0, $max = 5),
        ],
        'points_usage'=> [
            'Jan' => $faker->numberBetween($min =0, $max = 5),
            'Feb' => $faker->numberBetween($min =0, $max = 5),
            'Mar' => $faker->numberBetween($min =0, $max = 5),
            'Apr' => $faker->numberBetween($min =0, $max = 5),
            'May' => $faker->numberBetween($min =0, $max = 5),
            'Jun' => $faker->numberBetween($min =0, $max = 5),
            'July' => $faker->numberBetween($min =0, $max = 5),
            'Aug' => $faker->numberBetween($min =0, $max = 5),
            'Sept' => $faker->numberBetween($min =0, $max = 5),
            'Nov' => $faker->numberBetween($min =0, $max = 5),
            'Dec' => $faker->numberBetween($min =0, $max = 5),
        ],

    ];
});
