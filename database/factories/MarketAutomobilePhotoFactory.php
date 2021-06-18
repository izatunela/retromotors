<?php
namespace Database\Factories;

use App\Models\MarketAutomobile;
use App\Models\MarketAutomobilePhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketAutomobilePhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketAutomobilePhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{

		// $path = 'Images/User_images/'.$market_automobile->user->name.'/Market_images/Automobile/'.$market_automobile->id.'_'.$market_automobile->title_slug.'/';
		// mkdir(storage_path('app/public/'.$path),0777,true);
		// $image_name = mt_rand(1,32).'.jpg';
		// copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/'.$image_name));
		// copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/tn-'.$image_name));

		return [
			'market_automobile_id'=>MarketAutomobile::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
