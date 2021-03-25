<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HeroTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for ($i = 0; $i < 110; $i++) {
            DB::table('heros')->insert([
                'name' => $faker->firstName . ' ' . $faker->lastName,
            ]);
        }
    }
}
