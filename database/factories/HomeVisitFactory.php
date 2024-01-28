<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\HomeVisit;

$factory->define(HomeVisit::class, function (Faker $faker) {
    return [
        'name' => $faker->title,
        'address' => $faker ->title,
        'phone' => $faker ->phoneNumber,
        'email' => $faker->email,
        'sex'  => $faker->numberBetween(0,1),
        'dateTime' => $faker->dateTime
    ];
});
