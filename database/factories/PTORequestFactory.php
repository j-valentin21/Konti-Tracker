<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\PTORequest;
use App\User;
use Faker\Generator as Faker;

$factory->define(PTORequest::class, function (Faker $faker) {
    $dt = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
    $date = $dt->format("Y-m-d");
    return [
        'user_id' =>  User::all()->random()->id,
        'reason_for_request' => $faker->sentence($nbWords = 3),
        'pto_days' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 10),
        'dates' => [$date],
        'start_times' => [$date],
        'end_times' => [$date],
    ];
});
