<?php

use Illuminate\Database\Seeder;

class HouseMaterialsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('house_materials')->insert([
            ['name' => '木造'],
            ['name' => '土蔵造'],
            ['name' => '石造'],
            ['name' => 'れんが造'],
            ['name' => 'コンクリートブロック造'],
            ['name' => '鉄骨造'],
            ['name' => '鉄筋コンクリート造'],
            ['name' => '鉄骨鉄筋コンクリート造'],
        ]);
    }
}
