<?php

use Faker\Generator as Faker;
use App\Customer;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        //
        'name' => $faker->firstName." ".$faker->lastName,
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'notes' => $faker->paragraph
    ];
});
