<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdministratorSeeder::class);
        $this->call(UserSeeder::class);
        // $this->call(MarketSeeder::class);
        $this->call(GallerySeeder::class);
        $this->call(MarketAutomobileSeeder::class);
        $this->call(MarketMotorcycleSeeder::class);
        $this->call(MarketTruckSeeder::class);
        $this->call(MarketPartsSeeder::class);
        $this->call(MarketEquipmentSeeder::class);
    }
}
