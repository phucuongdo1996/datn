<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        DB::table('categories')->insert([
            ['name' => 'お知らせ' , 'color' => '#02AC80'],
            ['name' => '活動・実績', 'color' => '#099DBD'],
            ['name' => '調査・研究', 'color' => '#D06060'],
            ['name' => 'イベント', 'color' => '#F3B029'],
            ['name' => '採用情報', 'color' => '#8E62BA'],
        ]);
    }
}
