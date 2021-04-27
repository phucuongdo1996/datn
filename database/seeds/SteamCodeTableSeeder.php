<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SteamCodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('steam_code')->truncate();
        foreach (STEAM_CODE_ARRAY as $item) {
            for ($i = 0; $i < 100; $i++) {
                DB::table('steam_code')->insert([
                    'steam_code' => rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999),
                    'steam_seri' => rand(1000, 9999) . ' ' . rand(1000, 9999) . ' ' . rand(1000, 9999),
                    'type' => $item,
                    'status' => STEAM_CODE_READY
                ]);
            }
        }
    }
}
