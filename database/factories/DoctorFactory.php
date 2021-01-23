<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Doctor;
use Faker\Generator as Faker;

$factory->define(Doctor::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'percentage' => $faker->numberBetween(0,50),
        'wallet' => $faker->numberBetween(0,10000),
        'lifetime_wallet' => $faker->numberBetween(1000,100000),
        'no_patients' => $faker->numberBetween(0,500)
    ];
});
