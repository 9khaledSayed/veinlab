<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\SubAnalysis;

$factory->define(SubAnalysis::class, function (Faker $faker) {
    return [
            'main_analysis_id' => factory(\App\MainAnalysis::class),
            'name' => $faker->name,
            'unit' => $faker->name
    ];
});
