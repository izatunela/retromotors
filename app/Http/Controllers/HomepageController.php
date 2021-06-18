<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\MarketAutomobile;
use App\Models\MarketMotorcycle;
use App\Models\MarketTruck;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
	// public function __construct()
	// {
	// 	$this->middleware('auth')->except([
	// 		'home'
	// 	]);
	// }

    public function home()
    {
		// session()->flush();
    	$auto = MarketAutomobile::with('marketPhotoThumbnail')->has('marketPhotoThumbnail');
    	$moto = MarketMotorcycle::with('marketPhotoThumbnail')->has('marketPhotoThumbnail');
    	$truck = MarketTruck::with('marketPhotoThumbnail')->has('marketPhotoThumbnail');
    	$gallery = Gallery::with('galleryPhotoThumbnail')->has('galleryPhotoThumbnail');

    	// if ($auto->count()) {
    	// 	$rauto = $auto->get()->random();
    	// }
    	// if ($moto->count()) {
    	// 	$rmoto = $moto->get()->random();
    	// }
    	// if ($truck->count()) {
    	// 	$rtruck = $truck->get()->random();
    	// }
    	// if ($gallery->count()) {
    	// 	$rgallery = $gallery->get()->random();
    	// }

    	return view('pages/home',['auto'=>$auto??null,'moto'=>$moto??null,'truck'=>$truck??null,'gallery'=>$gallery??null]);
    }

	public function about()
	{
		return view('pages/about');
	}
}
