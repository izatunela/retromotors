<?php
namespace Database\Factories;

use App\Models\BrandsTruck;
use App\Models\MarketTruck;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketTruckFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketTruck::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users_count = User::count();
        $brands = BrandsTruck::all();
        $brand = $brands[mt_rand(0,$brands->count()-1)];
        if ($brand->name === 'Ostalo') {
            $brand->name = 'Nova marka';
            $brand->name_slug = 'nova-marka';
        }
        $model = 'model-'.mt_rand(1,99);
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
            'views'=>mt_rand(1,1000),
            'title_slug'=>$year.'-'.$brand->name_slug.'-'.$model,
            'title'=>$year.' '.$brand->name.' '.$model,
            'brand_id'=>$brand->id,
            'model'=>$model,
            'type_id'=>mt_rand(1,4),
            'manufacture_year'=>$year,
            'country_id'=>mt_rand(1,6),
            'city'=>$this->faker->city,
            'color_id'=>mt_rand(1,16),
            'transmission_id'=>mt_rand(1,2),
            'fuel_id'=>mt_rand(1,2),
            'axle_id'=>mt_rand(1,5),
            'capacity'=>mt_rand(500,50000),
            'vehicle_registration_id' => mt_rand(1,4),
            'condition_id'=>mt_rand(1,4),
            'kilometerage'=>mt_rand(5000,200000),
            'volume'=>mt_rand(1000,5000),
            'power'=>mt_rand(100,1000),
            'price'=>$price,
            'fixed_price'=>$fixed_price,
            'negotiate_price'=>$negotiate_price,
            'description'=>'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, impedit aliquid nostrum ut, sint, qui, quas voluptate dignissimos provident quidem ipsam expedita. Perspiciatis nesciunt ut ipsam, ex aliquam voluptatem nam.',
            'contact_phone' => mt_rand(0000000000,9999999999)
        ];
    }
}
