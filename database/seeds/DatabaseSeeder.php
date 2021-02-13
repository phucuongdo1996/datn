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
        $this->call(SpecialtiesTableSeeder::class);
        $this->call(RealEstateTypesTableSeeder::class);
        $this->call(DetailRealEstateTypesTableSeeder::class);
        $this->call(TypesRentalsTableSeeder::class);
        $this->call(LandRightsTableSeeder::class);
        $this->call(BuildingRightsTableSeeder::class);
        $this->call(HouseMaterialsTableSeeder::class);
        $this->call(HouseRootTypesTableSeeder::class);
        $this->call(AreasSeeder::class);
        $this->call(IndexFormulasSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AdminTableSeeder::class);
    }
}
