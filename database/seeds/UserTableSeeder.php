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
        DB::table('users')->truncate();
        $faker = Faker\Factory::create();
        DB::table('users')->insert([
            'user_code' => substr(hash('SHA256', $faker->name), 0, 5),
            'email' => 'phucuongdo1996@gmail.com',
            'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
            'nick_name' => 'Phu_Cuong_Do',
            'avatar' => '15.jpeg',
            'steam_url' => $faker->url,
            'money_own' => rand(1000, 50000000),
        ]);
        for ($i = 0; $i < 50; $i++) {
            DB::table('users')->insert([
                'user_code' => substr(hash('SHA256', $faker->name), 0, 5),
                'email' => $faker->unique()->safeEmail,
                'password' => \Illuminate\Support\Facades\Hash::make('123456789'),
                'nick_name' => $faker->firstName,
                'avatar' => rand(1, 15) . '.jpeg',
                'steam_url' => $faker->url,
                'money_own' => rand(1000, 50000000),
            ]);
        }
    }
}
