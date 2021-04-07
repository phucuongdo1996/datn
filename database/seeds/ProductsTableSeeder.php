<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
//        $faker = Faker\Factory::create();
        $userIds = \App\Models\User::all()->pluck('id')->toArray();
        $productBases = \App\Models\ProductBase::all()->pluck('id')->toArray();
        for ($i = 0; $i < 1000; $i++) {
            DB::table('products')->insert([
                'product_base_id' => $productBases[array_rand($productBases, 1)],
                'user_id' => $userIds[array_rand($userIds, 1)],
                'price' => rand(5000, 40000000)
            ]);
        }
    }
}
