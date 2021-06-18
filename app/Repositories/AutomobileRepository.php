<?php

namespace App\Repositories;

use App\Models\MarketAutomobile;
use App\Models\ModelsAutomobile;
use App\Models\BrandsAutomobile;
use App\Models\CustomBrandsModels;
use App\Services\MarketService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class AutomobileRepository
{
	/**
	 * MarketAutomobile instance
	 *
	 * @var Model
	 **/
	protected $model;

	function __construct(MarketAutomobile $model)
	{
		$this->model = $model;
	}

	private function getAutomobileBrands()
	{
    	return BrandsAutomobile::pluck('name','name_slug');
	}

	public function getAutomobileItems($request)
	{
		$query = MarketAutomobile::with('marketPhotoThumbnail');
		if ($request->brand) {
            BrandsAutomobile::where('name_slug',$request->brand)->first();
            // dd($request->brand);
            $brand_id = BrandsAutomobile::where('name_slug',$request->brand)->first()->id;
			$query->where('brand_id',$brand_id);
		}

		$result = $query->orderBy('created_at','desc')
                    ->paginate(12);

		return [
		    'market_category'=>'automobile',
            'MarketItems'=>$result ,
            'brands'=>$this->getAutomobileBrands()
        ];
	}

	public function getCreateAutomobileFormData()
	{
		return ['cities'=>MarketService::getCities(),'brands'=>$this->getAutomobileBrands()];
	}

	public function storeAutomobileItem($request)
	{
		$user = $request->user();

		$brand = BrandsAutomobile::where('name',$request->brand)->first();
		$model = ModelsAutomobile::where('name',$request->model)->first();
		$brand_name = $request->brand;
		$model_name = $request->model;

		if ($request->has('custom_model') || $request->has('custom_brand')) {
			if ($request->brand === 'Ostalo') {
				$brand_name = $request->custom_brand;
			}
			if ($request->model === 'Ostalo') {
				$model_name = $request->custom_model;
			}
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

		$marketAutomobile 							= new MarketAutomobile;

		$marketAutomobile->user_id 					= $user->id;
		$marketAutomobile->title_slug 				= $title_slug;
		$marketAutomobile->title 					= $title;
		$marketAutomobile->country_id 				= $request->country;
		$marketAutomobile->city 					= $request->city;
		$marketAutomobile->brand_id 				= $brand->id;
		$marketAutomobile->model_id 				= $model->id;
		$marketAutomobile->type_id 					= $request->type;
		$marketAutomobile->manufacture_year 		= $request->manufacture_year;
		$marketAutomobile->transmission_id 			= $request->transmission;
		$marketAutomobile->drivetrain_id 			= $request->drivetrain;
		$marketAutomobile->fuel_id 					= $request->fuel;
		$marketAutomobile->color_id 				= $request->color;
		$marketAutomobile->vehicle_registration_id 	= $request->vehicle_registration;
		$marketAutomobile->condition_id 			= $request->condition;
		$marketAutomobile->kilometerage 			= $request->kilometerage;
		$marketAutomobile->volume 					= $request->volume;
		$marketAutomobile->power 					= $request->power;
		$marketAutomobile->price 					= $request->price;
		$marketAutomobile->fixed_price 				= $request->fixed_price;
		$marketAutomobile->negotiate_price			= $request->negotiate_price;
		$marketAutomobile->description				= $request->description;
		$marketAutomobile->contact_phone			= $request->contact_phone;

		$marketAutomobile->save();

		if ($request->has('custom_model') || $request->has('custom_brand')) {
			$customBrandsModels->market_automobile_id = $marketAutomobile->id;
			$customBrandsModels->save();
		}
		$photos_order = json_decode($request->photosOrder);

		MarketService::storeImages($user,$marketAutomobile->id,$category = 'Automobile',$title_slug,$photos_order);

		return ['market_category'=>'automobile','id'=>$marketAutomobile->id,'title'=>$marketAutomobile->title_slug];
	}

	public function showAutomobileItem($item)
	{
		MarketService::marketViewCounter($item,'a');

		return ['Item'=>$item,'market_category'=>'automobile'];
	}

	public function editAutomobileItem($id)
	{
		$item = MarketAutomobile::find($id);
    	//odraditi autorizaciju za sve ostale na bolji nacin
		$cities = MarketService::getCities();
		$brand = BrandsAutomobile::with('getAutoModels')->find($item->brand_id);

		$models = $brand->getAutoModels->pluck('name','name');
		// $last_model = ModelsAutomobile::orderBy('id','desc')->pluck('name','name')->first();
		$models->put('Ostalo','Ostalo');

		$brands = BrandsAutomobile::pluck('name','name');

		return ['item'=>$item,'cities'=>$cities,'brands'=>$brands,'models'=>$models,'category'=>'Automobile'];

	}

	public function updateAutomobileItem($request)
	{
		$user = $request->user();
		$category = 'Automobile';

		$brand = BrandsAutomobile::where('name',$request->brand)->first();
		$model = ModelsAutomobile::where('name',$request->model)->first();
		$brand_name = $brand->name;
		$model_name = $model->name;

		if ($request->has('custom_brand') || $request->has('custom_model')) {
			if ($request->brand === 'Ostalo') {
				$brand_name = $request->custom_brand;
			}
			if ($request->model === 'Ostalo') {
				$model_name = $request->custom_model;
			}
			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;

			$customBrandsModels = CustomBrandsModels::firstOrNew(['market_automobile_id' => $request->id]);
			$customBrandsModels->name_slug = Str::slug($new_title,'-');
			$customBrandsModels->brand = $brand_name;
			$customBrandsModels->model = $model_name;
			$customBrandsModels->save();
		}
		else {
			$new_title = $request->manufacture_year.' '.$brand_name.' '.$model_name;
			$custom_automobile = CustomBrandsModels::where('market_automobile_id',$request->id);
			if ($custom_automobile->exists()) {
				$custom_automobile->forceDelete();
			}
		}

		$new_title_slug = Str::slug($new_title,'-');

		$marketAutomobile 							= MarketAutomobile::find($request->id);
		$title_slug 								= $marketAutomobile->title_slug;

		$marketAutomobile->title_slug 				= $new_title_slug;
		$marketAutomobile->title 					= $new_title;
		$marketAutomobile->country_id 				= $request->country;
		$marketAutomobile->city 					= $request->city;
		$marketAutomobile->brand_id 				= $brand->id;
		$marketAutomobile->model_id 				= $model->id;
		$marketAutomobile->type_id 					= $request->type;
		$marketAutomobile->manufacture_year 		= $request->manufacture_year;
		$marketAutomobile->transmission_id 			= $request->transmission;
		$marketAutomobile->drivetrain_id 			= $request->drivetrain;
		$marketAutomobile->fuel_id 					= $request->fuel;
		$marketAutomobile->color_id 				= $request->color;
		$marketAutomobile->vehicle_registration_id 	= $request->vehicle_registration;
		$marketAutomobile->condition_id 			= $request->condition;
		$marketAutomobile->kilometerage 			= $request->kilometerage;
		$marketAutomobile->volume 					= $request->volume;
		$marketAutomobile->power 					= $request->power;
		$marketAutomobile->price 					= $request->price;
		$marketAutomobile->fixed_price 				= $request->fixed_price;
		$marketAutomobile->negotiate_price			= $request->negotiate_price;
		$marketAutomobile->description 				= $request->description;
		$marketAutomobile->contact_phone			= $request->contact_phone;

		$marketAutomobile->save();

		$ordered_photos = json_decode($request->orderedPhotos);
		$delete_list = json_decode($request->deleteList);

		if (!empty($delete_list)) {
			MarketService::deleteStoredImage($user,$request->id,$category,$title_slug,$delete_list);
		}

		MarketService::storeUpdateImages($user,$request->id,$category,$title_slug,$new_title_slug,$marketAutomobile,$ordered_photos);

		return ['market_category'=>'automobile','id'=>$marketAutomobile->id,'title'=>$marketAutomobile->title_slug];
	}
}
