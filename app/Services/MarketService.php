<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\City;
use Image;
use Illuminate\Support\Facades\Cookie;

class MarketService
{
	public static function storeImages($user,$market_id,$category,$title,$photos_order)
	{
		ini_set('memory_limit','256M');

		$market_model_photo_class 	= '\\App\\Market'.$category.'Photo';
		$market_photo_cat_id 		= 'market_'.lcfirst($category).'_id';
		$username 					= $user->name_slug;
		
		// $temp_photos_path 	= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/temp/'.session('marketID').'/';
		$temp_photos_path 	= 'public/Images/User_images/Market_images/temp/'.session('marketID').'/';
		$perm_photos_path 	= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$title.'/';
		$db_path 			= 'Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$title.'/';

		$temp_photos = Storage::files($temp_photos_path);
		
		foreach ($photos_order as $photo) {
			$extension = pathinfo($photo,PATHINFO_EXTENSION);
			$prefix = uniqid();
			$filename = $prefix.'.'.$extension;
			Storage::move($temp_photos_path.$photo,$perm_photos_path.$filename);

			$marketPhoto 							= new $market_model_photo_class;
			$marketPhoto->$market_photo_cat_id 		= $market_id;
			$marketPhoto->filename 					= $filename;
			$marketPhoto->path 						= $db_path;
			$marketPhoto->save();

			$img = Image::make(storage_path().'/app/'.$perm_photos_path.$filename);
			$thumbnail = clone $img;
			$watermark = Image::make(public_path('img/wm.png'));

			$thumbnail->resize(220, null, function ($constraint) {
				$constraint->aspectRatio();
			});
			$thumbnail->save(storage_path().'/app/'.$perm_photos_path.'/tn-'.$filename);
			$img->insert($watermark, 'bottom-right', 10, 10);
			$img->save();
		}
		Storage::deleteDirectory($temp_photos_path);
	}


	public static function storeUpdateImages($user,$market_id,$category,$title,$new_title,$marketItem,$ordered_photos)
	{
		ini_set('memory_limit','256M');

		$market_model_photo_class 	= '\\App\\Market'.$category.'Photo';
		$market_photo_cat_id 		= 'market_'.lcfirst($category).'_id';
		$username 					= $user->name_slug;

		// $temp_photos_path 		= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/edit-temp/'.session('marketID').'/';
		$temp_photos_path 		= 'public/Images/User_images/Market_images/edit-temp/'.session('marketID').'/';
		$perm_photos_path 		= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$new_title.'/';
		$old_perm_photos_path 	= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$title.'/';
		$db_path 				= 'Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$new_title.'/';
		if (file_exists(storage_path('app/'.$old_perm_photos_path)) /*&& file_exists(storage_path('app/'.$perm_photos_path))*/) {
			rename(storage_path('app/'.$old_perm_photos_path), storage_path('app/'.$perm_photos_path));
		}
		
		$temp_photos = Storage::files($temp_photos_path);

		foreach ($temp_photos as $key => $temp_photo) {
			foreach ($ordered_photos as $key => $photo) {
				if (basename($temp_photo) == $photo) {
					$extension = pathinfo($temp_photo,PATHINFO_EXTENSION);
					$prefix = uniqid();
					$filename = $prefix.'.'.$extension;
					$ordered_photos[$key] = $filename;


					Storage::move($temp_photo,$perm_photos_path.$filename);

					$marketPhoto 							= new $market_model_photo_class;
					$marketPhoto->$market_photo_cat_id 		= $market_id;
					$marketPhoto->filename 					= $filename;
					$marketPhoto->path 						= $db_path;
					$marketPhoto->save();

					$img = $thumbnail = Image::make(storage_path().'/app/'.$perm_photos_path.$filename);
					$thumbnail = clone $img;
					$watermark = Image::make(public_path('img/wm.png'));

					$img->insert($watermark, 'bottom-right', 10, 10);
					$img->save();
					$thumbnail->resize(220, null, function ($constraint) {
						$constraint->aspectRatio();
					});
					$thumbnail->save(storage_path().'/app/'.$perm_photos_path.'/tn-'.$filename);
				}
				
			}
		}

		$uploadovaneFotke = $marketItem->marketAllPhotos;

		foreach ($uploadovaneFotke as $key => $val) {
			$uploadovaneFotke[$key]->filename = $ordered_photos[$key];
			$uploadovaneFotke[$key]->path = $db_path;
			$uploadovaneFotke[$key]->save();
		}
		Storage::deleteDirectory($temp_photos_path);
	}

	public static function deleteStoredImage($user,$market_id,$category,$title,$delete_list)
	{
		$username = $user->name_slug;

		$perm_photos_path 		= 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/'.$market_id.'_'.$title.'/';
		$marketCategoryClass 	= '\\App\\Market'.$category;
		$marketCategory 		= $marketCategoryClass::find($market_id);

		$uploadovaneFotke = $marketCategory->marketAllPhotos;

		foreach ($uploadovaneFotke as $key => $photo) {
			if (in_array($photo->filename, $delete_list)) {
				$photo->delete();
				Storage::delete([$perm_photos_path.$photo->filename,$perm_photos_path.'tn-'.$photo->filename]);
			}
		}
	}

	public static function getCities()
	{
		return City::pluck('name','name');
	}

	public static function marketViewCounter($item,$cat)
	{
		$cookie_views_str = Cookie::get('retromotors_v') ?? json_encode(['a'=>[],'m'=>[],'t'=>[],'p'=>[],'e'=>[]]);
		// $cookie_views_str = $_COOKIE['retromotors_a_v'] ?? json_encode(['a'=>[],'m'=>[],'t'=>[],'p'=>[],'e'=>[]]);
		// var_dump($cookie_views_str);
		// exit;
		// $cookie_views_arr = explode(':', $cookie_views_str);
		$cookie_views_arr = json_decode($cookie_views_str,true);
		// print_r($cookie_views_arr['a'][0]);
		// exit;
		// var_dump($cookie_views_arr);
		if (!in_array($item->id, $cookie_views_arr[$cat])) {
			array_push($cookie_views_arr[$cat], $item->id);
			// print_r($cookie_views_arr);
			// exit;
			// $cookie_views_str = implode(':', $cookie_views_arr);
			$cookie_views_str = json_encode($cookie_views_arr);
			// print_r($cookie_views_str);
			// exit;
			Cookie::queue(Cookie::make('retromotors_v',$cookie_views_str, 3600 ));
			// setcookie('retromotors_a_v',$cookie_views_str,time() + 3000 ,'/');
			$item->views += 1;
			$item->save();
		}
	}

}