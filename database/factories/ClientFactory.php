<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Client;
use Faker\Generator as Faker;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'company_name' => $faker->company,
        'company_address' => $faker->streetAddress,
        'company_reg' => $faker->ean13,
        'company_contact' => $faker->e164PhoneNumber,
    ];
});
