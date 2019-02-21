<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\User::class, function (Faker $faker) {
    $username = $faker->userName;

    return [
        'username' => $username,
        'company_name' => $faker->company,
        'email' => $username . '@email.com',
        'email_verified_at' => now(),
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'phone_number' => '01' . $faker->randomNumber(8, true),
        'd_o_b' => $faker->date,
        'master_code' => str_random(6),
        'master_id' => 4,
        'remember_token' => str_random(10),
    ];
});
