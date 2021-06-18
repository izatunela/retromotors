<?php

namespace Database\Seeders;

use App\Models\MarketTruck;
use App\Models\MarketTruckPhoto;
use Illuminate\Database\Seeder;

class MarketTruckSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketTruck::factory()->has(
            MarketTruckPhoto::factory(),'marketAllPhotos')
        ->count(10)
        ->create();
    }
}
