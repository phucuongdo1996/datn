<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductBaseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products_base')->truncate();
        $faker = Faker\Factory::create();
        $heroIds = \App\Models\Hero::all()->pluck('id')->toArray();
        for ($i = 0; $i < 1000; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'type' => TYPE_SET_CATEGORY
            ]);
        }
        $categories = \App\Models\Category::all()->pluck('id')->toArray();
        for ($i = 0; $i < 1000; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'category_id' => $categories[array_rand($categories, 1)],
                'type' => TYPE_ITEM_CATEGORY
            ]);
        }
    }
}
