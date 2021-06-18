<?php
namespace Database\Factories;

use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Database\Eloquent\Factories\Factory;

class GalleryPhotoFactory extends Factory
{
	/**
	 * The name of the factory's corresponding model.
	 *
	 * @var string
	 */
	protected $model = GalleryPhoto::class;

	/**
	 * Define the model's default state.
	 *
	 * @return array
	 */
	public function definition()
	{
		// $path = 'Images/User_images/'.$gallery->user->name.'/Gallery_images/'.$gallery->id.'_'.$gallery->title_slug.'/';

		// $image_name = mt_rand(1,32).'.jpg';

		// mkdir(storage_path('app/public/'.$path),0777,true);
		// copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/'.$image_name));
		// copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/tn-'.$image_name));

		return [
			'gallery_id'=>Gallery::factory(),
			'filename'=>mt_rand(1,32).'.jpg',
			'path'=>'mockups/'
		];
	}
}
