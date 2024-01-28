<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\normalRange;

$factory->define(normalRange::class, function (Faker $faker) {
    return [
        'sub_analysis_id' => factory(\App\SubAnalysis::class),
        'from' => $faker->numberBetween(1, 100),
        'to' => $faker->numberBetween(1, 100),
        'gender' => $faker->numberBetween(0, 3),
        'value' => $faker->randomFloat(2, 1, 10),
    ];
});
