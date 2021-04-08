<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsNewTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Product New
        DB::table('products_new')->truncate();
        $productBases = \App\Models\ProductBase::all()->pluck('id')->toArray();
        for ($i = 1; $i < 21; $i++) {
            DB::table('products_new')->insert([
                'product_base_id' => $productBases[array_rand($productBases, 1)],
            ]);
        }
        // Product bestseller
        DB::table('products_bestseller')->truncate();
        $productBases = \App\Models\ProductBase::all()->pluck('id')->toArray();
        for ($i = 1; $i < 21; $i++) {
            DB::table('products_bestseller')->insert([
                'product_base_id' => $productBases[array_rand($productBases, 1)],
            ]);
        }
        // Product bestseller
        DB::table('products_remarkable')->truncate();
        $productBases = \App\Models\ProductBase::all()->pluck('id')->toArray();
        for ($i = 1; $i < 21; $i++) {
            DB::table('products_remarkable')->insert([
                'product_base_id' => $productBases[array_rand($productBases, 1)],
            ]);
        }
    }
}
