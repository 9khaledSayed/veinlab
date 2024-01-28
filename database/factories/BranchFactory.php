<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HR\Branch;
use Faker\Generator as Faker;

$factory->define(Branch::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'address' => $faker->address,
    ];
});
