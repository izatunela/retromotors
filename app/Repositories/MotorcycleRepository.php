<?php

namespace App\Repositories;

use App\Models\MarketMotorcycle;
use App\Models\BrandsMotorcycle;
use App\Models\CustomBrandsModels;
use App\Services\MarketService;
use Illuminate\Support\Str;

// use Illuminate\Support\Facades\Storage;
// use Image;

class MotorcycleRepository
{


	// private function getMotorcycles()
	// {
	// 	return MarketMotorcycle::with('marketPhotoThumbnail')->paginate(12);
	// }

	private function getMotorcycleBrands()
	{
    	return BrandsMotorcycle::pluck('name','name_slug');
	}

	public function getMotorcycleItems($request)
	{
		$query = MarketMotorcycle::with('marketPhotoThumbnail');

		if ($request->brand) {
			$brand_id = BrandsMotorcycle::where('name_slug',$request->brand)->first()->id;
			$query->where('brand_id',$brand_id);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12);

		return ['market_category'=>'motorcycle','MarketItems'=>$result,'brands'=>$this->getMotorcycleBrands()];
	}

	public function getCreateMotorcycleFormData()
	{
		return ['cities'=>MarketService::getCities(),'brands'=>$this->getMotorcycleBrands()];
	}

	public function storeMotorcycleItem($request)
	{
		$user = $request->user();
		$brand = BrandsMotorcycle::where('name',$request->brand)->first();
		$brand_name = $request->brand;
		$model_name = $request->model;

		if ($request->has('custom_brand') && $request->brand === 'Ostalo') {
			$brand_name = $request->custom_brand;

			$title = $request->manufacture_year.' '.$brand_name.' '.$model_name;

			$customBrandsModels = new CustomBrandsModels;
			$customBrandsModels->name_slug = Str::slug($title,'-');
			$customBrandsModels->brand = $brand_name;
			$customBrandsModels->model = $model_name;
			$customBrandsModels->save();
		}
		else {
			$title = $request->manufacture_year.' '.$brand_name.' '.$model_name;
		}
		$title_slug = Str::slug($title,'-');

		$marketMotorcycle 							= new MarketMotorcycle;

		$marketMotorcycle->user_id 					= $user->id;
		$marketMotorcycle->title_slug 				= $title_slug;
		$marketMotorcycle->title 					= $title;
		$marketMotorcycle->country_id 				= $request->country;
		$marketMotorcycle->city 					= $request->city;
		$marketMotorcycle->brand_id 				= $brand->id;
		$marketMotorcycle->model 					= $request->model;
		$marketMotorcycle->type_id 					= $request->type;
		$marketMotorcycle->manufacture_year 		= $request->manufacture_year;
		$marketMotorcycle->transmission_id 			= $request->transmission;
		$marketMotorcycle->color_id 				= $request->color;
		$marketMotorcycle->cylinder_id 				= $request->cylinder;
		$marketMotorcycle->vehicle_registration_id 	= $request->vehicle_registration;
		$marketMotorcycle->condition_id 			= $request->condition;
		$marketMotorcycle->kilometerage 			= $request->kilometerage;
		$marketMotorcycle->volume 					= $request->volume;
		$marketMotorcycle->power 					= $request->power;
		$marketMotorcycle->price					= $request->price;
		$marketMotorcycle->fixed_price 				= $request->fixed_price;
		$marketMotorcycle->negotiate_price			= $request->negotiate_price;
		$marketMotorcycle->description 				= $request->description;
		$marketMotorcycle->contact_phone 			= $request->contact_phone;

		$marketMotorcycle->save();

		if ($request->has('custom_brand') && $request->brand === 'Ostalo') {
			$customBrandsModels->market_motorcycle_id = $marketMotorcycle->id;
			$customBrandsModels->save();
		}

		$photos_order = json_decode($request->photosOrder);
		MarketService::storeImages($user,$marketMotorcycle->id,$category = 'Motorcycle',$title_slug,$photos_order);

		return ['market_category'=>'motorcycle','id'=>$marketMotorcycle->id,'title'=>$marketMotorcycle->title_slug];

	}

	public function showMotorcycleItem($item)
	{
		MarketService::marketViewCounter($item,'m');

		return ['Item'=>$item,'market_category'=>'motorcycle'];
	}

	public function editMotorcycleItem($id)
	{
		$item = MarketMotorcycle::find($id);
    	//odraditi autorizaciju za sve ostale na bolji nacin
		$cities = MarketService::getCities();
		$brand = BrandsMotorcycle::find($item->brand_id);

		$brands = BrandsMotorcycle::pluck('name','name');

		return ['item'=>$item,'cities'=>$cities,'brands'=>$brands,'category'=>'Motorcycle'];

	}

	public function updateMotorcycleItem($request)
	{

		$user = $request->user();
		$category = 'Motorcycle';
		$brand = BrandsMotorcycle::where('name',$request->brand)->first();
		$brand_name = $request->brand;
		$model_name = $request->model;
		if ($request->has('custom_brand')) {
			$brand_name = $request->custom_brand;

			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;

			$customBrandsModels = CustomBrandsModels::firstOrNew(['market_motorcycle_id' => $request->id]);
			$customBrandsModels->name_slug = Str::slug($new_title,'-');
			$customBrandsModels->brand = $brand_name;
			$customBrandsModels->model = $model_name;
			$customBrandsModels->save();
		}
		else {
			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;
			$custom_motorcycle = CustomBrandsModels::where('market_motorcycle_id',$request->id);
			if ($custom_motorcycle->exists()) {
				$custom_motorcycle->forceDelete();
			}
		}

		$new_title_slug = Str::slug($new_title,'-');

		$marketMotorcycle 							= MarketMotorcycle::find($request->id);
		$title_slug 								= $marketMotorcycle->title_slug;

		$marketMotorcycle->title_slug 				= $new_title_slug;
		$marketMotorcycle->title 					= $new_title;
		$marketMotorcycle->country_id 				= $request->country;
		$marketMotorcycle->city 					= $request->city;
		$marketMotorcycle->brand_id 				= $brand->id;
		$marketMotorcycle->model 					= $request->model;
		$marketMotorcycle->type_id 					= $request->type;
		$marketMotorcycle->manufacture_year 		= $request->manufacture_year;
		$marketMotorcycle->transmission_id 			= $request->transmission;
		$marketMotorcycle->color_id 				= $request->color;
		$marketMotorcycle->cylinder_id 				= $request->cylinder;
		$marketMotorcycle->vehicle_registration_id 	= $request->vehicle_registration;
		$marketMotorcycle->condition_id 			= $request->condition;
		$marketMotorcycle->kilometerage 			= $request->kilometerage;
		$marketMotorcycle->volume 					= $request->volume;
		$marketMotorcycle->power 					= $request->power;
		$marketMotorcycle->price 					= $request->price;
		$marketMotorcycle->fixed_price 				= $request->fixed_price;
		$marketMotorcycle->negotiate_price 			= $request->negotiate_price;
		$marketMotorcycle->description 				= $request->description;
		$marketMotorcycle->contact_phone 			= $request->contact_phone;

		$marketMotorcycle->save();

		$ordered_photos = json_decode($request->orderedPhotos);
		$delete_list = json_decode($request->deleteList);

		if (!empty($delete_list)) {
			MarketService::deleteStoredImage($user,$request->id,$category,$title_slug,$delete_list);
		}

		MarketService::storeUpdateImages($user,$request->id,$category,$title_slug,$new_title_slug,$marketMotorcycle,$ordered_photos);

		return ['market_category'=>'motorcycle','id'=>$marketMotorcycle->id,'title'=>$marketMotorcycle->title_slug];
	}
}
