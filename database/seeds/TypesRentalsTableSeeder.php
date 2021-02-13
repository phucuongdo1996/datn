<?php

use Illuminate\Database\Seeder;

class TypesRentalsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('types_rentals')->insert([
            ['name' => '旧法賃借権'],
            ['name' => '普通賃借権'],
            ['name' => '一般定期借地権（法22条）'],
            ['name' => '事業用定期借地権（法23条）'],
            ['name' => '建物譲渡特約付借地権（法24条）'],
        ]);
    }
}
