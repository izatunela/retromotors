<?php
namespace Database\Factories;

use App\Models\MarketTruck;
use App\Models\MarketTruckPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketTruckPhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketTruckPhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'market_truck_id'=>MarketTruck::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
