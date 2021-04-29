<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarketTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('market')->truncate();
        $userIds = \App\Models\User::all()->pluck('id')->toArray();
        $products = \App\Models\Product::select('id', 'price')->get()->toArray();
        $count = count($products);
        for ($i = 0; $i < 5000; $i++) {
            $randomProduct = $i % $count;
            $date = date("Y-m-d H:i:s", rand(1609599600, 1618395069));
            DB::table('market')->insert([
                'seller_id' => $userIds[array_rand($userIds, 1)],
                'product_id' => $products[$randomProduct]['id'],
                'price' => $products[$randomProduct]['price'],
                'price_real' => $products[$randomProduct]['price'] * 0.9,
                'status' => TRADE_SELLING,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            for ($k = 1; $k < 6; $k++) {
                $date2 = date("Y-m-d H:i:s", rand(1609599600, 1618395069));
                DB::table('market')->insert([
                    'seller_id' => $userIds[array_rand($userIds, 1)],
                    'buyer_id' => $userIds[array_rand($userIds, 1)],
                    'product_id' => $products[$randomProduct]['id'],
                    'price' => rand($products[$randomProduct]['price'] * 0.9, $products[$randomProduct]['price'] * 1.1),
                    'price_real' => rand($products[$randomProduct]['price'] * 0.9, $products[$randomProduct]['price'] * 1.1) * 0.9,
                    'status' => TRADE_DONE,
                    'created_at' => $date2,
                    'updated_at' => $date2,
                ]);
            }
        }
    }
}
