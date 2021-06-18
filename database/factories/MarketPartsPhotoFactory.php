<?php
namespace Database\Factories;

use App\Models\MarketParts;
use App\Models\MarketPartsPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketPartsPhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketPartsPhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'market_parts_id'=>MarketParts::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
