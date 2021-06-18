<?php

namespace App\Repositories;

use App\Models\MarketEquipment;
use App\Services\MarketService;
use Illuminate\Support\Str;

class EquipmentRepository
{
	private function getEquipment()
	{
		return MarketEquipment::with('marketPhotoThumbnail')->orderBy('created_at','desc')->paginate(12);
	}

	public function getAllEquipmentItems()
	{
		return ['market_category'=>'equipment','MarketItems'=>$this->getEquipment()];
	}

	public function getCreateEquipmentFormData()
	{
		return ['cities'=>MarketService::getCities()];
	}

	public function storeEquipmentItem($request)
	{

		$user = $request->user();
		// $title = strtolower( str_replace(['/',' '], '-', $request->title) );
		$title = $request->title;
		$title_slug = Str::slug($title,'-');

		$marketEquipment = new MarketEquipment;

		$marketEquipment->user_id 				= $user->id;
		$marketEquipment->title_slug 			= $title_slug;
		$marketEquipment->title 				= $title;
		$marketEquipment->country_id 			= $request->country;
		$marketEquipment->city 					= $request->city;
		$marketEquipment->condition_id 			= $request->condition;
		$marketEquipment->price 				= $request->price;
		$marketEquipment->fixed_price 			= $request->fixed_price;
		$marketEquipment->negotiate_price		= $request->negotiate_price;
		$marketEquipment->description 			= $request->description;
		$marketEquipment->contact_phone 		= $request->contact_phone;

		$marketEquipment->save();

		$photos_order = json_decode($request->photosOrder);
		MarketService::storeImages($user,$marketEquipment->id,$category = 'Equipment',$title_slug,$photos_order);

		return ['market_category'=>'equipment','id'=>$marketEquipment->id,'title'=>$marketEquipment->title_slug];
	}

	public function showEquipmentItem($item)
	{
		MarketService::marketViewCounter($item,'e');

		return ['Item'=>$item,'market_category'=>'equipment'];
	}

	public function editEquipmentItem($id)
	{
		$item = MarketEquipment::find($id);
		//odraditi autorizaciju za sve ostale na bolji nacin
		$cities = MarketService::getCities();

		return ['item'=>$item,'cities'=>$cities,'category'=>'Equipment'];

	}

	public function updateEquipmentItem($request)
	{
		$user = $request->user();
		$category = 'Equipment';

		// $new_title = strtolower(str_replace(['/',' '], '-', $request->title));
		$new_title = $request->title;
		$new_title_slug = Str::slug($new_title,'-');

		$marketEquipment 						= MarketEquipment::find($request->id);
		$title_slug 							= $marketEquipment->title_slug;

		$marketEquipment->title_slug 			= $new_title_slug;
		$marketEquipment->title 				= $new_title;
		// $marketEquipment->user_id 				= $user->id;
		$marketEquipment->country_id 			= $request->country;
		$marketEquipment->city 					= $request->city;
		$marketEquipment->condition_id 			= $request->condition;
		$marketEquipment->price 				= $request->price;
		$marketEquipment->fixed_price 			= $request->fixed_price;
		$marketEquipment->negotiate_price		= $request->negotiate_price;
		$marketEquipment->description 			= $request->description;
		$marketEquipment->contact_phone 		= $request->contact_phone;

		$marketEquipment->save();

		$ordered_photos = json_decode($request->orderedPhotos);
		$delete_list = json_decode($request->deleteList);

		if (!empty($delete_list)) {
			MarketService::deleteStoredImage($user,$request->id,$category,$title_slug,$delete_list);
		}

		MarketService::storeUpdateImages($user,$request->id,$category,$title_slug,$new_title_slug,$marketEquipment,$ordered_photos);

		return ['market_category'=>'equipment','id'=>$marketEquipment->id,'title'=>$marketEquipment->title_slug];
	}
}
