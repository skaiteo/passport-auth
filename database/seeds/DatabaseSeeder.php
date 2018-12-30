<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        for ($i=0; $i < 10; $i++) { 
            DB::table('users')->insert([
                'username' => 'user'.$i,
                'company_name' => str_random(8),
                'email' => 'testee'.$i.'@tester.com',
                'password' => bcrypt('secret'),
                'phone_number' => rand(60100000, 60199999),
                'd_o_b' => rand(1800, 2018).'-'.rand(1, 12).'-'.rand(10, 31)
            ]);
        }

        for ($i=0; $i < 10; $i++) { 
            DB::table('passports')->insert([
                "firstname" => "IMMIGRANT",
                "lastname" => $i."",
                "passport_num" => str_random(6),
                "country" => str_random(3),
                "d_o_b" => rand(1800, 2018).'-'.rand(1, 12).'-'.rand(10, 31),
                "gender" => "MALE",
                "expiry_date" => rand(1800, 2018).'-'.rand(1, 12).'-'.rand(10, 31)
            ]);
        }
    }
}
