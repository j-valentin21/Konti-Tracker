<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calendar;
use App\User;
use Faker\Generator as Faker;

$factory->define(Calendar::class, function (Faker $faker) {
    $dt = $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now');
    $date = $dt->format("Y-m-d");
    return [
        'user_id'=> User::all()->random()->id,
        'event_name' => $faker->sentence($nbWords = 3),
        'start_date' => $date,
        'end_date' => $date,
    ];
});
