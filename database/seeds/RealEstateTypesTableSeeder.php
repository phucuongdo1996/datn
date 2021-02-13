<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RealEstateTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('real_estate_types')->truncate();
        DB::table('real_estate_types')->insert([
            ['name' => 'オフィスビル_事務所', 'bank_uses' => 'オフィスビル'],
            ['name' => 'レジデンス_住宅', 'bank_uses' => 'レジデンス'],
            ['name' => 'リテール_店舗', 'bank_uses' => 'リテール'],
            ['name' => 'ホテル・旅館', 'bank_uses' => 'ヘルスケア・ホテル'],
            ['name' => 'ロジスティクス_倉庫', 'bank_uses' => 'ロジ・インダストリー'],
            ['name' => '工場・作業所・データセンター', 'bank_uses' => 'ロジ・インダストリー'],
            ['name' => '病院・診療所', 'bank_uses' => 'ヘルスケア・ホテル'],
            ['name' => 'ヘルスケア', 'bank_uses' => 'ヘルスケア・ホテル'],
            ['name' => '土地_及び構築物', 'bank_uses' => 'その他_土地・底地等'],
            ['name' => '底地_借地権付の土地の所有権', 'bank_uses' => 'その他_土地・底地等'],
        ]);
    }
}
