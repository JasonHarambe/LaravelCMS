<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use App\Client;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'client_id' => Client::all()->random()->id,
        'product_id' => $faker->bankAccountNumber,
        'product_name' => $faker->word,
        'product_amount' => $faker->numberBetween($min = 1, $max = 100),
        'product_unit_price' => $faker->randomFloat($nbMaxDecimals = 2, $min = 0, $max = 50),
        'printed' => 'no',
    ];
});
