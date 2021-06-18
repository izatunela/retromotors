<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MarketController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

	public function create()
	{	
		return view('market/create');
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function storeTempImages(Request $request)
	{
		$username = $request->user()->name_slug;
		$category = ucfirst($request->category);

		if ($request->hasFile('market_photos')) {
			$files = $request->file('market_photos');
			// $temp_path = 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/temp/'.session('marketID').'/';
			$temp_path = 'public/Images/User_images/Market_images/temp/'.session('marketID').'/';
			foreach($files as $file){
				$extension = $file->getClientOriginalExtension();
				$file->storeAs($temp_path,$file->getClientOriginalName());
			}
		}
	}

	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function storeEditTempImages(Request $request)
	{
		$username = $request->user()->name_slug;
		$category = ucfirst($request->category);

		if ($request->hasFile('market_photos')) {
			$files = $request->file('market_photos');
			// $temp_path = 'public/Images/User_images/'.$username.'/Market_images/'.$category.'/edit-temp/'.session('marketID').'/';
			$temp_path = 'public/Images/User_images/Market_images/edit-temp/'.session('marketID').'/';
			foreach($files as $file){
				$extension = $file->getClientOriginalExtension();
				$file->storeAs($temp_path,$request->fn);
			}
		}
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function editGetPhotos(Request $request)
	{
		$category = ucfirst($request->category);
		$marketCategory = '\\App\\Market'.$category;
		$item = $marketCategory::find($request->id);
		$photos = $item->marketAllPhotos;
		// foreach ($photos as $photo) {
			// $photo->filename = 'tn-'.$photo->filename;
		// }
		return response()->json(['photos'=>$photos,'photos_len'=>$photos->count()]);
	}

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function FunctionName(Type $var = null)
	{
		# code...
	}
}