<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Hospital;
use Faker\Generator as Faker;

$factory->define(Hospital::class, function (Faker $faker) {
    return [
        'name'  => $faker->streetName,
        'email' => $faker->email,
        'phone' => $faker->phoneNumber,
        'password' => $faker->password,
        'percentage' => $faker->numberBetween(0,50),
        'wallet' => $faker->numberBetween(0,10000),
        'lifetime_wallet' => $faker->numberBetween(1000,100000),
        'no_patients' => $faker->numberBetween(0,500)
    ];
});
