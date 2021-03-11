<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DotaCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('dota_category')->truncate();
        DB::table('dota_category')->insert([
            ['name' => 'Item thường' , 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Item có hiệu ứng', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Khiêu khích (Taunt)', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Thú vận chuyển thường (Courier)', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Thú vận chuyển lạ thường (Unusual Courier )', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Mắt (Wards)', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Địa hình (Terrian)', 'type' => TYPE_ITEM_CATEGORY],
            ['name' => 'Arcana', 'type' => TYPE_ITEM_CATEGORY],
        ]);
    }
}
