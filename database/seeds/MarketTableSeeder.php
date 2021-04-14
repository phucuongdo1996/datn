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
        $half = floor($count / 2);
        for ($i = 0; $i < $half; $i++) {
            DB::table('market')->insert([
                'seller_id' => $userIds[array_rand($userIds, 1)],
                'product_id' => $products[$i]['id'],
                'price' => $products[$i]['price'],
                'status' => TRADE_SELLING
            ]);
        }
        for ($i = $half; $i < $count; $i++) {
            DB::table('market')->insert([
                'seller_id' => $userIds[array_rand($userIds, 1)],
                'buyer_id' => $userIds[array_rand($userIds, 1)],
                'product_id' => $products[$i]['id'],
                'price' => $products[$i]['price'],
                'status' => TRADE_DONE
            ]);
        }
    }
}
