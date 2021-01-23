<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Patient;
use Faker\Generator as Faker;

$factory->define(Patient::class, function (Faker $faker) {
    return [
            'name'  => $faker->name,
            'email' => $faker->email,
            'phone' => $faker->phoneNumber,
            'password' => $faker->password
    ];
});
