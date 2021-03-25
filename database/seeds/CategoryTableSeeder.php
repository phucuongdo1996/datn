<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('category')->truncate();
        DB::table('category')->insert([
            ['name' => 'Item thường'],
            ['name' => 'Item có hiệu ứng'],
            ['name' => 'Khiêu khích (Taunt)'],
            ['name' => 'Thú vận chuyển thường (Courier)'],
            ['name' => 'Thú vận chuyển lạ thường (Unusual Courier )'],
            ['name' => 'Mắt (Wards)'],
            ['name' => 'Địa hình (Terrian)'],
            ['name' => 'Arcana'],
        ]);
    }
}
