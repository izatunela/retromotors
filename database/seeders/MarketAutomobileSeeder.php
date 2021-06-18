<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MarketAutomobile;
use App\Models\MarketAutomobilePhoto;

class MarketAutomobileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketAutomobile::factory()->has(
            MarketAutomobilePhoto::factory(),'marketAllPhotos')
        ->count(10)
        ->create();
    }
}
