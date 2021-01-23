<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\PromoCode;

$factory->define(PromoCode::class, function (Faker $faker) {
    return [
        'code' =>$faker->numberBetween(0,1000000)
    ];
});
