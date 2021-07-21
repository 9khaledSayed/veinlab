<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\HR\EmployeeRequest;

use Faker\Generator as Faker;

$factory->define(EmployeeRequest::class, function (Faker $faker) {
    return [
        'type' => '1',
        'comment' => $faker->sentence,
        'directed_to_ar' => $faker->name,
        'directed_to_eng' => $faker->name,
        'reason' => $faker->sentence,
    ];
});
