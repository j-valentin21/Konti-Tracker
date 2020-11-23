<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Calendar;
use Faker\Generator as Faker;

$factory->define(Calendar::class, function (Faker $faker) {
    return [
        'id' => 1,
        'user_id'=> 1,
        'event_name' => $faker->name(),
        'start_date' => $faker->dateTime,
        'end_date' => $faker->dateTime,
    ];
});
