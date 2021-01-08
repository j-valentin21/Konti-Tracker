<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;

$factory->define(Illuminate\Notifications\DatabaseNotification::class, function (Faker $faker) {
    return [
        'id' => $faker->uuid,
        'type' => "App\Notifications\PTORequestStatus",
        'notifiable_type' => "App\User",
        'notifiable_id' => User::all()->random()->id,
        "data" => [
            'name' => $faker->name(),
            'message' => $faker->sentence($nbWords = 6)
        ]
    ];
});
