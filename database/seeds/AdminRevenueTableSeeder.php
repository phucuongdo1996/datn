<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminRevenueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_revenue')->truncate();
        $dateEnd= (new \DateTime())->getTimestamp();
        $dateStart = (new \DateTime('-5 months'))->getTimestamp();
        for ($i = 1; $i < 1000; $i++) {
            $date = date("Y-m-d H:i:s", rand($dateStart, $dateEnd));
            DB::table('admin_revenue')->insert([
                'type' => REVENUE_AGENCY,
                'value' => rand(10000, 50000),
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
        for ($i = 1; $i < 20; $i++) {
            $date = date("Y-m-d H:i:s", rand($dateStart, $dateEnd));
            DB::table('admin_revenue')->insert([
                'type' => REVENUE_STEAM_CODE,
                'value' => STEAM_CODE_MONEY[array_rand(STEAM_CODE_MONEY)],
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
        for ($i = 1; $i < 200; $i++) {
            $date = date("Y-m-d H:i:s", rand($dateStart, $dateEnd));
            DB::table('admin_revenue')->insert([
                'type' => REVENUE_RECHARGE_MONEY,
                'value' => rand(1,5) * 50000,
                'created_at' => $date,
                'updated_at' => $date
            ]);
        }
    }
}
