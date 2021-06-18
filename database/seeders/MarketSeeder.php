<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MarketAutomobilePhotoSeeder::class);
        $this->call(MarketMotorcyclePhotoSeeder::class);
        $this->call(MarketTruckPhotoSeeder::class);
        $this->call(MarketPartsPhotoSeeder::class);
        $this->call(MarketEquipmentPhotoSeeder::class);
    }
}
