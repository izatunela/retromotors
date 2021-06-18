<?php
namespace Database\Factories;

use App\Models\MarketParts;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class MarketPartsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MarketParts::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $users_count = User::count();
        $title = $this->faker->catchPhrase;
        $title_slug = Str::slug($title,'-');
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
            'title_slug'=>$title_slug,
            'title'=>$title,
            'vehicle_category_id'=>mt_rand(1,3),
            'brand_id'=>mt_rand(1,35),
            'country_id'=>mt_rand(1,6),
            'city'=>$this->faker->city,
            'condition_id'=>mt_rand(1,2),
            'price'=>$price,
            'fixed_price'=>$fixed_price,
            'negotiate_price'=>$negotiate_price,
            'description'=>$this->faker->realText($maxNbChars = 200, $indexSize = 2),
            'contact_phone' => mt_rand(0000000000,9999999999)
        ];
    }
}
