<?php

namespace Database\Seeders;

use App\Models\MarketEquipment;
use App\Models\MarketEquipmentPhoto;
use Illuminate\Database\Seeder;

class MarketEquipmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketEquipment::factory()->has(
            MarketEquipmentPhoto::factory(),'marketAllPhotos')
        ->count(10)
        ->create();
    }
}
