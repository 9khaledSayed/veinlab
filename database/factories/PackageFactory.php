<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Package;

$factory->define(Package::class, function (Faker $faker) {
    return [
        'name'  => $faker->sentence,
        'price' => $faker->numberBetween(100, 500),
    ];
});
