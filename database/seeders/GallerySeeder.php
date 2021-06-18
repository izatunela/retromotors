<?php

namespace Database\Seeders;

use App\Models\Gallery;
use App\Models\GalleryPhoto;
use Illuminate\Database\Seeder;

class GallerySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Gallery::factory()->has(
            GalleryPhoto::factory(),'galleryAllPhotos')
        ->count(5)
        ->create();


        // Gallery::factory()->has(
        //     GalleryPhoto::factory()
        //     ->state(function(array $attributes,Gallery $gallery)
        //     {
        //         $path = 'Images/User_images/'.$gallery->user->name.'/Gallery_images/'.$gallery->id.'_'.$gallery->title_slug.'/';
        //         mkdir(storage_path('app/public/'.$path),0777,true);

        //         $image_name = mt_rand(1,32).'.jpg';

        //         copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/'.$image_name));
        //         copy(public_path('mockups/'.$image_name), storage_path('app/public/'.$path.'/tn-'.$image_name));

        //         return [
        //             'path'=>$path,
        //             'filename'=>$image_name
        //         ];
        //     }),'galleryAllPhotos')
        // ->count(20)
        // ->create();
    }
}
