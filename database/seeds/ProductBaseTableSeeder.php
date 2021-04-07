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
        // Item thường
        for ($i = 1; $i < 64; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 1,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Item có hiệu ứng
        for ($i = 1; $i < 31; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 2,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Item khiêu khích
        for ($i = 1; $i < 42; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 3,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Item courier
        for ($i = 1; $i < 29; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
//                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 4,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Item courier co hieu ung
        for ($i = 1; $i < 29; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
//                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 5,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Item wards
        for ($i = 1; $i < 11; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
//                'hero_id' => $heroIds[array_rand($heroIds, 1)],
                'category_id' => 6,
                'type' => TYPE_ITEM_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
        // Set
        for ($i = 1; $i < 102; $i++) {
            DB::table('products_base')->insert([
                'name' => $faker->sentence,
                'hero_id' => $heroIds[array_rand($heroIds, 1)],
//                'category_id' => 6,
                'type' => TYPE_SET_CATEGORY,
                'image' => $i . '.png'
            ]);
        }
    }
}
