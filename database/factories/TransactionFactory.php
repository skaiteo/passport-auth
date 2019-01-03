<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'passport_id' => $faker->numberBetween(0, 999),
        'sender_id' => $faker->numberBetween(0, 999),
        'receiver_id' => $faker->numberBetween(0, 999),
        'attachments' => $faker->sentence(6)
    ];
});
