<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 25)->create();
        factory(App\Passport::class, 25)->create();
        factory(App\Transaction::class, 25)->create();
    }
}
