<?php

use Illuminate\Database\Seeder;

class LandRightsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('land_rights')->insert([
            ['name' => '所有権（100％）'],
            ['name' => '所有権（共有）'],
            ['name' => '所有権（一部共有） '],
            ['name' => '所有権 （分有）'],
            ['name' => '所有権（一部分有）'],
            ['name' => '所有権・借地権'],
            ['name' => '所有権・使用貸借権・借地権'],
            ['name' => '敷地利用権（所有権）'],
            ['name' => '敷地利用権（借地権）'],
            ['name' => '敷地利用権（所有権・借地権）'],
            ['name' => '敷地利用権（一部共有）'],
            ['name' => '借地権（100％）'],
            ['name' => '借地権（共有）'],
            ['name' => '借地権（一部共有）'],
            ['name' => '借地権 （分有）'],
            ['name' => '借地権（一部分有）'],
            ['name' => '地上権（100％）'],
            ['name' => '地上権（共有）'],
            ['name' => '地上権（一部共有）'],
            ['name' => '地上権 （分有）'],
            ['name' => '地上権（一部分有）'],
            ['name' => '使用貸借（無償）'],
        ]);
    }
}
