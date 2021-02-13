<?php

use Illuminate\Database\Seeder;

class BuildingRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('building_rights')->insert([
            ['name' => '所有権（100％）'],
            ['name' => '所有権（共有）'],
            ['name' => '所有権（一部共有） '],
            ['name' => '所有権 （分有）'],
            ['name' => '所有権（一部分有）'],
            ['name' => '区分所有権（100％）'],
            ['name' => '区分所有権（共有）'],
            ['name' => '区分所有権（一部共有） '],
            ['name' => '区分所有権 （分有）'],
            ['name' => '区分所有権（一部分有）'],
        ]);
    }
}
