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
        $userIds = \App\Models\User::all()->pluck('id')->toArray();
        $productBases = \App\Models\ProductBase::all()->pluck('id')->toArray();
        foreach ($productBases as $item) {
            $price = rand(5000, 40000000);
            for ($i = 0; $i < 100; $i++) {
                DB::table('products')->insert([
                    'product_base_id' => $productBases[array_rand($productBases, 1)],
                    'user_id' => $userIds[array_rand($userIds, 1)],
                    'price' => rand($price * 0.9, $price * 1.1)
                ]);
            }
        }
    }
}
