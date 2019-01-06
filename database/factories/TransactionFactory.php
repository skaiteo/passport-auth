<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'passport_id' => rand(1, 1000),
        'sender_id' => rand(1, 1000),
        'receiver_id' => rand(1, 1000),
        'received' => rand(0, 1),
        'attachments' => $faker->sentence(6)
    ];
});
