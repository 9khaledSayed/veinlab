<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->randomLetter,
        'company_id' => factory(\App\Company::class),
        'percentage' => $faker->numberBetween(0,100)
    ];
});
