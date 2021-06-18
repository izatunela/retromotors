<?php

namespace App\Repositories;

use App\Models\MarketTruck;
use App\Models\BrandsTruck;
use App\Models\CustomBrandsModels;
use App\Services\MarketService;
use Illuminate\Support\Str;

class TruckRepository
{


	// private function getTrucks()
	// {
	// 	return MarketTruck::with('marketPhotoThumbnail')->paginate(12);
	// }

	private function getTruckBrands()
	{
    	return BrandsTruck::pluck('name','name_slug');
	}

	public function getTruckItems($request)
	{
		$query = MarketTruck::with('marketPhotoThumbnail');
		// $query = \DB::table('market_automobile')->select('*');
		if ($request->brand) {
			$brand_id = BrandsTruck::where('name_slug',$request->brand)->first()->id;
			$query->where('brand_id',$brand_id);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12);

		return ['market_category'=>'truck','MarketItems'=>$result,'brands'=>$this->getTruckBrands()];
	}

	public function getCreateTruckFormData()
	{
		return ['cities'=>MarketService::getCities(),'brands'=>$this->getTruckBrands()];
	}

	public function storeTruckItem($request)
	{
		$user = $request->user();
		$brand = BrandsTruck::where('name',$request->brand)->first();
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

		$marketTruck 							= new MarketTruck;

		$marketTruck->user_id 					= $user->id;
		$marketTruck->title_slug 				= $title_slug;
		$marketTruck->title 					= $title;
		$marketTruck->country_id 				= $request->country;
		$marketTruck->city 						= $request->city;
		$marketTruck->brand_id 					= $brand->id;
		$marketTruck->model 					= $request->model;
		$marketTruck->type_id 					= $request->type;
		$marketTruck->manufacture_year			= $request->manufacture_year;
		$marketTruck->transmission_id 			= $request->transmission;
    	$marketTruck->fuel_id 					= $request->fuel;
    	$marketTruck->axle_id 					= $request->axle;
    	$marketTruck->capacity 					= $request->capacity;
		$marketTruck->color_id 					= $request->color;
		$marketTruck->vehicle_registration_id 	= $request->vehicle_registration;
		$marketTruck->condition_id 				= $request->condition;
		$marketTruck->kilometerage 				= $request->kilometerage;
		$marketTruck->volume 					= $request->volume;
		$marketTruck->power 					= $request->power;
		$marketTruck->price						= $request->price;
		$marketTruck->fixed_price 				= $request->fixed_price;
		$marketTruck->negotiate_price			= $request->negotiate_price;
		$marketTruck->description 				= $request->description;
		$marketTruck->contact_phone 			= $request->contact_phone;

		$marketTruck->save();

		if ($request->has('custom_brand') && $request->brand === 'Ostalo') {
			$customBrandsModels->market_truck_id = $marketTruck->id;
			$customBrandsModels->save();
		}
		$photos_order = json_decode($request->photosOrder);
		MarketService::storeImages($user,$marketTruck->id,$category = 'Truck',$title_slug,$photos_order);

		return ['market_category'=>'truck','id'=>$marketTruck->id,'title'=>$marketTruck->title_slug];

	}

	public function showTruckItem($item)
	{
		MarketService::marketViewCounter($item,'t');

		return ['Item'=>$item,'market_category'=>'truck'];
	}

	public function editTruckItem($id)
	{
		$item = MarketTruck::find($id);
    	//odraditi autorizaciju za sve ostale na bolji nacin
		$cities = MarketService::getCities();
		$brand = BrandsTruck::find($item->brand_id);

		$brands = BrandsTruck::pluck('name','name');

		return ['item'=>$item,'cities'=>$cities,'brands'=>$brands,'category'=>'Truck'];

	}

	public function updateTruckItem($request)
	{

		$user = $request->user();
		$category = 'Truck';
		$brand = BrandsTruck::where('name',$request->brand)->first();
		$brand_name = $request->brand;
		$model_name = $request->model;
		if ($request->has('custom_brand')) {
			$brand_name = $request->custom_brand;

			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;

			$customBrandsModels = CustomBrandsModels::firstOrNew(['market_truck_id' => $request->id]);
			$customBrandsModels->name_slug = Str::slug($new_title,'-');
			$customBrandsModels->brand = $brand_name;
			$customBrandsModels->model = $model_name;
			$customBrandsModels->save();
		}
		else {
			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;
			$custom_truck = CustomBrandsModels::where('market_truck_id',$request->id);
			if ($custom_truck->exists()) {
				$custom_truck->forceDelete();
			}
		}

		$new_title_slug = Str::slug($new_title,'-');

		$marketTruck 							= MarketTruck::find($request->id);
		$title_slug 							= $marketTruck->title_slug;

		$marketTruck->title_slug 				= $new_title_slug;
		$marketTruck->title 					= $new_title;
		$marketTruck->country_id 				= $request->country;
		$marketTruck->city 						= $request->city;
		$marketTruck->brand_id 					= $brand->id;
		$marketTruck->model 					= $request->model;
		$marketTruck->type_id 					= $request->type;
		$marketTruck->manufacture_year			= $request->manufacture_year;
		$marketTruck->transmission_id 			= $request->transmission;
    	$marketTruck->fuel_id 					= $request->fuel;
    	$marketTruck->axle_id 					= $request->axle;
    	$marketTruck->capacity 					= $request->capacity;
		$marketTruck->color_id 					= $request->color;
		$marketTruck->vehicle_registration_id 	= $request->vehicle_registration;
		$marketTruck->condition_id 				= $request->condition;
		$marketTruck->kilometerage 				= $request->kilometerage;
		$marketTruck->volume 					= $request->volume;
		$marketTruck->power 					= $request->power;
		$marketTruck->price						= $request->price;
		$marketTruck->fixed_price 				= $request->fixed_price;
		$marketTruck->negotiate_price 			= $request->negotiate_price;
		$marketTruck->description 				= $request->description;
		$marketTruck->contact_phone 			= $request->contact_phone;

		$marketTruck->save();

		$ordered_photos = json_decode($request->orderedPhotos);
		$delete_list = json_decode($request->deleteList);

		if (!empty($delete_list)) {
			MarketService::deleteStoredImage($user,$request->id,$category,$title_slug,$delete_list);
		}

		MarketService::storeUpdateImages($user,$request->id,$category,$title_slug,$new_title_slug,$marketTruck,$ordered_photos);

		return ['market_category'=>'truck','id'=>$marketTruck->id,'title'=>$marketTruck->title_slug];
	}
}
