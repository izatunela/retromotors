<?php

namespace App\Repositories;

use App\Models\MarketParts;
use App\Services\MarketService;
use App\Models\BrandsAutomobile;
use App\Models\BrandsMotorcycle;
use App\Models\BrandsTruck;
use Illuminate\Support\Str;

class PartsRepository
{
	private function getParts()
	{
		return MarketParts::with('marketPhotoThumbnail')->orderBy('created_at','desc')->paginate(12);
	}

	private function getAutomobileBrands()
	{
    	return BrandsAutomobile::pluck('name','id');
	}

	private function getMotorcycleBrands()
	{
    	return BrandsMotorcycle::pluck('name','id');
	}

	private function getTruckBrands()
	{
    	return BrandsTruck::pluck('name','id');
	}


	public function getAllPartsItems()
	{
		return ['market_category'=>'parts','MarketItems'=>$this->getParts()];
	}

	public function getCreatePartsFormData()
	{
		return ['cities'=>MarketService::getCities(),'auto'=>$this->getAutomobileBrands(),'moto'=>$this->getMotorcycleBrands(),'truc'=>$this->getTruckBrands()];
	}

	public function getPartsBrandName($item)
	{
		// $vehicle_cat = $item->vehicle->name;
    	// if ($vehicle_cat === 'automobile') {
    	// 	$brand_name = BrandsAutomobile::find($item->brand_id)->name;
    	// } else if ($vehicle_cat === 'motorcycle'){
    	// 	$brand_name = BrandsMotorcycle::find($item->brand_id)->name;
    	// }else {
    	// 	$brand_name = BrandsTruck::find($item->brand_id)->name;
    	// }
    	// return $brand_name;
	}

	public function storePartsItem($request)
	{

		$user = $request->user();
		// $title = strtolower( str_replace(['/',' '], '-', $request->title) );
		$title = $request->title;
		$title_slug = Str::slug($title,'-');

		$marketParts = new MarketParts;

		$marketParts->user_id 				= $user->id;
    	$marketParts->title_slug 			= $title_slug;
    	$marketParts->title 				= $title;
    	$marketParts->vehicle_category_id 	= $request->vehicle_category;
    	$marketParts->brand_id 				= $request->brand;
    	$marketParts->country_id 			= $request->country;
    	$marketParts->city 					= $request->city;
		$marketParts->condition_id 			= $request->condition;
    	$marketParts->price 				= $request->price;
		$marketParts->fixed_price 			= $request->fixed_price;
		$marketParts->negotiate_price		= $request->negotiate_price;
    	$marketParts->description 			= $request->description;
    	$marketParts->contact_phone 		= $request->contact_phone;

    	$marketParts->save();

		$photos_order = json_decode($request->photosOrder);
		MarketService::storeImages($user,$marketParts->id,$category = 'Parts',$title_slug,$photos_order);

		return ['market_category'=>'parts','id'=>$marketParts->id,'title'=>$marketParts->title_slug];
	}

	public function showPartsItem($item)
	{
		MarketService::marketViewCounter($item,'p');

		return ['Item'=>$item,'market_category'=>'parts'];
	}

	public function editPartsItem($id)
	{
		$item = MarketParts::find($id);
    	//odraditi autorizaciju za sve ostale na bolji nacin
		$cities = MarketService::getCities();
		// $auto = BrandsAutomobile::pluck('name','id');
		// $moto = BrandsMotorcycle::pluck('name','id');
		// $truc = BrandsTruck::pluck('name','id');

		return ['item'=>$item,'cities'=>$cities,'auto'=>$this->getAutomobileBrands(),'moto'=>$this->getMotorcycleBrands(),'truc'=>$this->getTruckBrands(),'category'=>'Parts'];

	}

	public function updatePartsItem($request)
    {
    	$user = $request->user();
    	$category = 'Parts';

    	// $new_title = strtolower(str_replace(['/',' '], '-', $request->title));
    	$new_title = $request->title;
    	$new_title_slug = Str::slug($new_title,'-');

		$marketParts 						= MarketParts::find($request->id);
		$title_slug 						= $marketParts->title_slug;

    	$marketParts->title_slug 			= $new_title_slug;
    	$marketParts->title 				= $new_title;
		// $marketParts->user_id 				= $user->id;
    	$marketParts->vehicle_category_id 	= $request->vehicle_category;
    	$marketParts->brand_id 				= $request->brand;
    	$marketParts->country_id 			= $request->country;
    	$marketParts->city 					= $request->city;
		$marketParts->condition_id 			= $request->condition;
    	$marketParts->price 				= $request->price;
		$marketParts->fixed_price 			= $request->fixed_price;
		$marketParts->negotiate_price		= $request->negotiate_price;
    	$marketParts->description 			= $request->description;
		$marketParts->contact_phone 		= $request->contact_phone;

    	$marketParts->save();

    	$ordered_photos = json_decode($request->orderedPhotos);
    	$delete_list = json_decode($request->deleteList);

    	if (!empty($delete_list)) {
    		MarketService::deleteStoredImage($user,$request->id,$category,$title_slug,$delete_list);
    	}

    	MarketService::storeUpdateImages($user,$request->id,$category,$title_slug,$new_title_slug,$marketParts,$ordered_photos);

		return ['market_category'=>'parts','id'=>$marketParts->id,'title'=>$marketParts->title_slug];
    }
}
