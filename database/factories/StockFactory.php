<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Stock;

$factory->define(Stock::class, function (Faker $faker) {
    return [
        'item' => $faker->name,
        'quantity' => $faker->numberBetween(10,1000)
    ];
});
