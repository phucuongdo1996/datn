<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);
        $this->call(HeroTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(ProductBaseTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(ProductsNewTableSeeder::class);
        $this->call(MarketTableSeeder::class);
        $this->call(SteamCodeTableSeeder::class);
    }
}
