<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\MainAnalysis;

$factory->define(MainAnalysis::class, function (Faker $faker) {
    return [
        'general_name'  => $faker->company,
        'abbreviated_name' => $faker->companySuffix,
        'code' => $faker->postcode,
        'price' => $faker->numberBetween(100,500),
        'discount' => $faker->numberBetween(10,50),
        'cost' => $faker->numberBetween(10,50),
        'demand_no' => $faker->numberBetween(1,50),
        'price_insurance' => $faker->numberBetween(100,500),

    ];
});
