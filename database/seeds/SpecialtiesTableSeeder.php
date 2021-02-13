<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecialtiesTableSeeder extends Seeder
{
    /**
     * Define list specialty of expert
     */
    private const EXPERTS = [
        '不動産コンサルタント', '金融機関担当者', '工務店', 'デザイナー', '生命（損害）保険代理店', 'インフラ業者（水道・ガス・電気）'
    ];

    /**
     * Define list specialty of broker
     */
    private const BROKERS = [
        '不動産売買仲介業者', '不動産管理（賃貸仲介・マンション管理士）会社', '不動産コンサルタント'
    ];

    /**
     * Define list qualifications of experts
     */
    private const QUALIFICATIONS = [
        '弁護士', '税理士', '不動産鑑定士', '司法書士', '行政書士', '建築士', '土地家屋調査士', '測量士', 'FP'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::EXPERTS as $name) {
            DB::table('specialties')->insert([
                'name' => $name,
                'type' => 0
            ]);
        }

        foreach (self::BROKERS as $name) {
            DB::table('specialties')->insert([
                'name' => $name,
                'type' => 1
            ]);
        }

        foreach (self::QUALIFICATIONS as $name) {
            DB::table('specialties')->insert([
                'name' => $name,
                'type' => 0
            ]);
        }
    }
}
