<?php
namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Gallery;
use App\Models\User;

class GalleryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Gallery::class;

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
        return [
            'user_id' => mt_rand(1,$users_count),
            'title_slug'=>$title_slug,
            'title'=>$title,
            'description'=> $this->faker->realText($maxNbChars = 200, $indexSize = 2),
        ];
    }
}
