<?php
namespace Database\Factories;

use App\Models\MarketMotorcycle;
use App\Models\MarketMotorcyclePhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketMotorcyclePhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketMotorcyclePhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'market_motorcycle_id'=>MarketMotorcycle::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
