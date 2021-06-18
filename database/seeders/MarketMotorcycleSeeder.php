<?php

namespace Database\Seeders;

use App\Models\MarketMotorcycle;
use App\Models\MarketMotorcyclePhoto;
use Illuminate\Database\Seeder;

class MarketMotorcycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketMotorcycle::factory()->has(
            MarketMotorcyclePhoto::factory(),'marketAllPhotos')
        ->count(10)
        ->create();
    }
}
