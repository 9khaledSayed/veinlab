<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Invoice;

$factory->define(Invoice::class, function (Faker $faker) {

    return [
        'patient_id'  => factory(\App\Patient::class),
        'main_analysis_id' => factory(\App\MainAnalysis::class),
        'total_price' => $faker->numberBetween(100, 500),
        'serial_no' => $faker->bankAccountNumber,
        'total_price' => $faker->bankAccountNumber,
    ];

});
