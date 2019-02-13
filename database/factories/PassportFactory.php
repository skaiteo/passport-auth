<?php

use Faker\Generator as Faker;

$factory->define(App\Passport::class, function (Faker $faker) {
    return [
        "firstname" => strtoupper($faker->firstName),
        "lastname" => strtoupper($faker->lastName),
        "passport_num" => $faker->randomNumber(8, true),
        "country" => $faker->countryCode,
        "d_o_b" => $faker->date('Y-m-d', '915148800'),
        "gender" => rand(0, 1) ? 'MALE' : 'FEMALE',
        "expiry_date" => $faker->date,
        "user_id" => rand(1, 5)
    ];
});
