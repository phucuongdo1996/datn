<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 100; $i++) {
            DB::table('users')->insert([
                'email' => $faker->unique()->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
                'nick_name' => $faker->firstName,
                'steam_url' => $faker->url,
                'money_own' => rand(1000, 50000000),
            ]);
        }
    }
}
