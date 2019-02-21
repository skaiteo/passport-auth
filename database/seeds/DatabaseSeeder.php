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
        factory(App\User::class, 3)->create();
        factory(App\Passport::class, 20)->create();
        factory(App\Transaction::class, 20)->create();
    }
}
