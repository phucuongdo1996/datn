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
        DB::table('heros')->truncate();
        $faker = Faker\Factory::create();
        for ($i = 1; $i < 89; $i++) {
            DB::table('heros')->insert([
                'name' => $faker->firstName . ' ' . $faker->lastName,
                'image' => $i . '.png',
            ]);
        }
    }
}
