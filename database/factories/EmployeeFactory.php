<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Employee::class, function (Faker $faker) {
    return [
        'fname_arabic'  => $faker->firstName,
        'lname_arabic'  => $faker->lastName,
        'fname_english'  => $faker->firstName,
        'lname_english'  => $faker->lastName,
        'birthdate'  => $faker->date('Y-m-d'),
        'joined_date'  => $faker->date('Y-m-d'),
        'nationality_id'  => '0',
        'branch_id'  => 1,
        'id_num'  => $faker->bankAccountNumber,
        'emp_num'  => $faker->randomNumber(5),
        'contract_type'  => $faker->randomElement([ 'limited','unlimited']),
        'start_date'  =>  $faker->date('Y-m-d'),
        'contract_period'  => 12,
        'basic_salary'  => $faker->numberBetween(1000, 5000),
        'phone'  => $faker->phoneNumber,
        'is_master'  => $faker->boolean,
        'shift_type'  => $faker->numberBetween(1, 2),
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
