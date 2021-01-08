<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Activity;
use App\User;
use Faker\Generator as Faker;

$factory->define(Activity::class, function (Faker $faker) {
    $dt = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
    $date = $dt->format("Y-m-d");
    return [
            'user_id' => User::all()->random()->id,
            'date' => $date,
            'time' => $faker->time(),
            'pto_used'=> $faker->numberBetween($min =0, $max = 10),
            'points' => $faker->numberBetween($min =0, $max = 10),
            'pending' => $faker->numberBetween($min =0, $max = 10),
            'reason_for_request' => $faker->sentence($nbWords = 3),
            'supervisor_name' => $faker->name,
            'status' => 'Accepted',
    ];
});
