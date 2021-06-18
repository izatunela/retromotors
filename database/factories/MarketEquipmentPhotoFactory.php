<?php
namespace Database\Factories;

use App\Models\MarketEquipment;
use App\Models\MarketEquipmentPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketEquipmentPhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketEquipmentPhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		return [
			'market_equipment_id'=>MarketEquipment::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
