<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailRealEstateTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('detail_real_estate_types')->truncate();
        DB::table('detail_real_estate_types')->insert([
            [
                'real_estate_type_id' => 1,
                'name' => '事務所'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・居宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・共同住宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・共同住宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・居宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・ホテル'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・ホテル・居宅'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・工場'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・倉庫'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・診療所'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・校舎'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・体育館'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・美術館'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・店舗・地域冷暖房施設'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・診療所'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・研修所'
            ],
            [
                'real_estate_type_id' => 1,
                'name' => '事務所・スポーツ施設'
            ],
            // レジデンス_住宅
            [
                'real_estate_type_id' => 2,
                'name' => '区分所有マンション'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・事務所'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・事務所・店舗'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・店舗'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・店舗・作業所'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・店舗・診療所'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・作業所・居宅'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・保育所'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・老人福祉施設'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '共同住宅・老人福祉施設・事務所'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '居宅'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '居宅・店舗'
            ],
            [
                'real_estate_type_id' => 2,
                'name' => '寄宿舎'
            ],
            // リテール_店舗
            [
                'real_estate_type_id' => 3,
                'name' => '店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・共同住宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・事務所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・事務所・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・事務所・共同住宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・事務所・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・事務所・ホテル '
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・スポーツ施設'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・温浴関連施設・店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・映画館'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・映画館・ホテル'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・映画館・ホテル・事務所・共同住宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・映画館・遊技場'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・映画館・百貨店・遊技場'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・会館'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・作業所・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・工場'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・診療所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '店舗・診療所・事務所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'ショッピングセンター'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '百貨店'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '百貨店・事務所・映画館'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '百貨店・老人福祉施設'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'スポーツ施設'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'スポーツ施設・事務所・店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'スポーツ施設・店舗・診療所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'スポーツ施設・店舗・事務所・診療所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => 'スポーツ施設・映画館・遊技場・店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '温浴関連施設'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '遊技場'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '遊技場・事務所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '遊技場・店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '遊技場・店舗・工場'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '教習所'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '教習所・居宅'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '教習所・店舗'
            ],
            [
                'real_estate_type_id' => 3,
                'name' => '教習所・店舗・事務所・居宅'
            ],
            // ホテル・旅館
            [
                'real_estate_type_id' => 4,
                'name' => '旅館'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル・居宅'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル・共同住宅'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル・事務所'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル・店舗'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => 'ホテル・事務所・店舗'
            ],
            [
                'real_estate_type_id' => 4,
                'name' => '簡易宿泊所'
            ],
            // ロジスティクス_倉庫
            [
                'real_estate_type_id' => 5,
                'name' => '倉庫'
            ],
            [
                'real_estate_type_id' => 5,
                'name' => '倉庫・事務所'
            ],
            [
                'real_estate_type_id' => 5,
                'name' => '倉庫・事務所・店舗'
            ],
            [
                'real_estate_type_id' => 5,
                'name' => '倉庫・工場・事務所'
            ],
            [
                'real_estate_type_id' => 5,
                'name' => '倉庫・作業所・事務所'
            ],
            // 工場・作業所・データセンター
            [
                'real_estate_type_id' => 6,
                'name' => '工場'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・倉庫'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・共同住宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・事務所'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・事務所・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・事務所・共同住宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・事務所・倉庫'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・店舗・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・作業所・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・作業所・事務所'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '工場・研究開発施設'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所・事務所'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所・事務所・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '作業所・事務所・共同住宅・居宅'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => 'データセンター'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '研究開発施設'
            ],
            [
                'real_estate_type_id' => 6,
                'name' => '研究所・事務所'
            ],
            // 病院・診療所
            [
                'real_estate_type_id' => 7,
                'name' => '病院'
            ],
            [
                'real_estate_type_id' => 7,
                'name' => '病院・店舗'
            ],
            [
                'real_estate_type_id' => 7,
                'name' => '診療所'
            ],
            [
                'real_estate_type_id' => 7,
                'name' => '診療所・居宅'
            ],
            [
                'real_estate_type_id' => 7,
                'name' => '診療所・店舗'
            ],
            // ヘルスケア
            [
                'real_estate_type_id' => 8,
                'name' => '介護施設'
            ],
            [
                'real_estate_type_id' => 8,
                'name' => '老人福祉施設'
            ],
            [
                'real_estate_type_id' => 8,
                'name' => '老人福祉施設・診療所'
            ],
            [
                'real_estate_type_id' => 8,
                'name' => '老人福祉施設・診療所・店舗'
            ],
            [
                'real_estate_type_id' => 8,
                'name' => '老人福祉施設・診療所・保育園・事務所・店舗'
            ],
            // 土地_及び構築物
            [
                'real_estate_type_id' => 9,
                'name' => '遊休地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '貸駐車場'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '田'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '畑'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '牧場'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '原野'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '塩田'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '鉱泉地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '池沼'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '山林'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '墓地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '境内地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '運河用地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '水道用地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '用悪水路'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => 'ため池'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '堤'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '井溝（せいこう）'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '保安林'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '公衆用道路'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '公園'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '鉄道用地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '学校用地'
            ],
            [
                'real_estate_type_id' => 9,
                'name' => '雑種地'
            ],
            // 底地_借地権付の土地の所有権
            [
                'real_estate_type_id' => 10,
                'name' => '底地'
            ],
        ]);
    }
}
