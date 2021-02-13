<?php

use Illuminate\Database\Seeder;

class HouseRootTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('house_roof_types')->insert([
            ['name' => '瓦葺'],
            ['name' => 'スレート葺'],
            ['name' => '亜鉛メッキ鋼板葺'],
            ['name' => '草葺'],
            ['name' => '陸屋根'],
        ]);
    }
}
