<?php

use Faker\Generator as Faker;

$factory->define(App\Transaction::class, function (Faker $faker) {
    return [
        'passport_id' => rand(1, 20),
        'sender_id' => rand(1, 5),
        'receiver_id' => rand(1, 5),
        'received' => rand(0, 1),
        'attachments' => $faker->sentence(4)
    ];
});
