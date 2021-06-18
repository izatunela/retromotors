<?php

namespace Database\Seeders;

use App\Models\MarketParts;
use App\Models\MarketPartsPhoto;
use Illuminate\Database\Seeder;

class MarketPartsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MarketParts::factory()->has(
            MarketPartsPhoto::factory(),'marketAllPhotos')
        ->count(10)
        ->create();
    }
}
