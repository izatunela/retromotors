<?php
namespace Database\Factories;

use App\Models\BrandsAutomobile;
use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\MarketAutomobile;
use App\Models\User;

class MarketAutomobileFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = MarketAutomobile::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		$users_count = User::count();
		$brands = BrandsAutomobile::all();
		// $brand = $brands[mt_rand(0,$brands->count()-1)];
		$brand = BrandsAutomobile::find(1);
		// if ($brand->name === 'Ostalo') {
		// 	$brand->name = 'Nova marka';
		// 	$brand->name_slug = 'nova-marka';
		// }
		$models = $brand->getAutoModels;
		$model = $brand->getAutoModels[mt_rand(0,$models->count()-1)];
		if ($model->name === 'Ostalo') {
			$model->name = 'Novi model';
			$model->name_slug = 'novi-model';
		}
		$year = mt_rand(1900,2019);
		$negotiate_price = mt_rand(0,1);
		if ($negotiate_price === 0) {
			$price = mt_rand(1,200000);
			$fixed_price = mt_rand(0,1);
		}
		else{
			$price = 0;
			$fixed_price = 0;
		}

		return [
			'user_id' => mt_rand(1,$users_count),
			'views' => mt_rand(1,1000),
			'title_slug' => $year.'-'.$brand->name_slug.'-'.$model->name_slug, #'1920-amphicar-770',
			'title' => $year.' '.$brand->name.' '.$model->name, #'1920 Amphicar 770',
			'brand_id' => $brand->id,
			'model_id' => $model->id,
			'type_id' => mt_rand(1,7),
			'manufacture_year' => $year,
			'country_id' => mt_rand(1,6),
			'city' => $this->faker->city,
			'color_id' => mt_rand(1,16),
			'drivetrain_id' => mt_rand(1,3),
			'transmission_id' => mt_rand(1,2),
			'fuel_id' => mt_rand(1,2),
			'vehicle_registration_id' => mt_rand(1,4),
			'condition_id' => mt_rand(1,4),
			'kilometerage' => mt_rand(5000,200000),
			'volume' => mt_rand(1000,5000),
			'power' => mt_rand(100,1000),
			'price' => $price,
			'fixed_price' => $fixed_price,
			'negotiate_price' => $negotiate_price,
			'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, impedit aliquid nostrum ut, sint, qui, quas voluptate dignissimos provident quidem ipsam expedita. Perspiciatis nesciunt ut ipsam, ex aliquam voluptatem nam.',
			'contact_phone' => mt_rand(0000000000,9999999999)
		];
	}
}
