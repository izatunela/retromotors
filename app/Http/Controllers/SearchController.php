<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MarketAutomobile;
use App\Models\MarketMotorcycle;
use App\Models\MarketTruck;
use App\Models\MarketParts;
use App\Models\MarketEquipment;
use App\Models\BrandsAutomobile;
use App\Models\BrandsMotorcycle;
use App\Models\BrandsTruck;
use App\Models\ModelsAutomobile;
use App\Models\TypeAutomobile;
use App\Models\TypeMotorcycle;
use App\Models\TypeTruck;

class SearchController extends Controller
{
	public function __construct()
	{

	}
	private function removeNullValues(array $keywords)
	{
		return array_filter($keywords,'strlen');
	}
	private function stripCommasAndSpaces(string $string)
	{
		return preg_replace('#(,|\s)+#', ' ', $string);
	}

	public function searchAutomobile(Request $request)
	{
		$keywords=$this->removeNullValues($request->all());
		$query = MarketAutomobile::with('marketPhotoThumbnail');

        if ($request->filled('brand')) {
            $brand = BrandsAutomobile::where('name_slug',$request->brand)->first();
			if (!is_null($brand)) {
				$models = $brand->getAutoModels()->pluck('name','name_slug');
				$query = $query->where('brand_id',$brand->id);
			}
		}
		if ($request->filled('model')) {
			$model = ModelsAutomobile::where('name_slug',$request->model)->first();
			if (!is_null($model)) {
				$query = $query->where('model_id',$model->id);
			}
		}
		if ($request->filled('min_manufacture_year')) {
			$query = $query->where('manufacture_year','>=',intval($request->min_manufacture_year));
		}
		if ($request->filled('max_manufacture_year') && $request->max_manufacture_year !== '0') {
			$query = $query->where('manufacture_year','<=',intval($request->max_manufacture_year));
		}
		if ($request->filled('fuel') && $request->fuel !== '0') {
			$query = $query->where('fuel_id',$request->fuel);
		}
		if ($request->filled('min_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','>=',$request->min_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('max_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','<=',$request->max_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('country') && $request->country !== '0') {
			$query = $query->where('country_id',$request->country);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12)->appends($keywords);
		return view('market/index-automobile',
            [
                'market_category'=>'automobile',
                'brands'=>BrandsAutomobile::pluck('name','name_slug'),
                'models'=>$models??null,
                'MarketItems'=>$result,
                'keywords'=>$keywords
            ]
        );
	}

	public function searchMotorcycle(Request $request)
	{
		$keywords = $this->removeNullValues($request->all());
		$query = MarketMotorcycle::with('marketPhotoThumbnail');

		if ($request->filled('brand') && $request->brand !== 'Svi proizvodjači') {
			$brand = BrandsMotorcycle::where('name',$request->brand)->first();
			$query = $query->where('brand_id',$brand->id);
		}
		if ($request->filled('model')) {
			$query = $query->where('model','like','%'.$request->model.'%');
		}
		if ($request->filled('type') && $request->type !== '0') {
			$query = $query->where('type_id',$request->type);
		}
		if ($request->filled('min_manufacture_year')) {
			$query = $query->where('manufacture_year','>=',intval($request->min_manufacture_year));
		}
		if ($request->filled('max_manufacture_year') && $request->max_manufacture_year !== '0') {
			$query = $query->where('manufacture_year','<=',intval($request->max_manufacture_year));
		}
		if ($request->filled('min_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','>=',$request->min_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('max_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','<=',$request->max_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('country') && $request->country !== '0') {
			$query = $query->where('country_id',$request->country);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12)->appends($keywords);
		return view('market/index-motorcycle',['market_category'=>'motorcycle','brands'=>BrandsMotorcycle::pluck('name','name'),'MarketItems'=>$result,'keywords'=>$keywords]);
	}

	public function searchTruck(Request $request)
	{
		$keywords = $this->removeNullValues($request->all());
		$query = MarketTruck::with('marketPhotoThumbnail');

		if ($request->filled('brand') && $request->brand !== 'Svi proizvodjači') {
			$brand = BrandsTruck::where('name',$request->brand)->first();
			$query = $query->where('brand_id',$brand->id);
		}
		if ($request->filled('model')) {
			$query = $query->where('model','like','%'.$request->model.'%');
		}
		if ($request->filled('type') && $request->type !== '0') {
			$query = $query->where('type_id',$request->type);
		}
		if ($request->filled('min_manufacture_year')) {
			$query = $query->where('manufacture_year','>=',intval($request->min_manufacture_year));
		}
		if ($request->filled('max_manufacture_year') && $request->max_manufacture_year !== '0') {
			$query = $query->where('manufacture_year','<=',intval($request->max_manufacture_year));
		}
		if ($request->filled('min_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','>=',$request->min_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('max_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','<=',$request->max_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('country') && $request->country !== '0') {
			$query = $query->where('country_id',$request->country);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12)->appends($keywords);
		return view('market/index-truck',['market_category'=>'truck','brands'=>BrandsTruck::pluck('name','name'),'MarketItems'=>$result,'keywords'=>$keywords]);
	}

	public function searchParts(Request $request)
	{
		$keywords = $this->removeNullValues($request->all());

		$query = MarketParts::with('marketPhotoThumbnail');
		if ($request->filled('keyword')) {
			$keywords['keyword'] = $this->stripCommasAndSpaces($keywords['keyword']);
			$pattern = implode('|',preg_split("#(,|\s)+#", $request->keyword));
			$query = $query->where('title','regexp','('.$pattern.')+');
		}
		if ($request->filled('vehicle_category') && $request->vehicle_category !== '0') {
			$query = $query->where('vehicle_category_id',$request->vehicle_category);
		}
		if ($request->filled('brand') && $request->brand !== 'Sve marke') {
			$query = $query->where('brand_id',$request->brand);
		}
		if ($request->filled('min_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','>=',$request->min_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('max_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','<=',$request->max_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('country') && $request->country !== '0') {
			$query = $query->where('country_id',$request->country);
		}
		if ($request->filled('condition') && $request->condition !== '0') {
			$query = $query->where('condition_id',$request->condition);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12)->appends($keywords);
		return view('market/index-parts',['market_category'=>'parts','brands'=>$brands??null,'MarketItems'=>$result,'keywords'=>$keywords]);
	}

	public function searchEquipment(Request $request)
	{
		$keywords = $this->removeNullValues($request->all());

		$query = MarketEquipment::with('marketPhotoThumbnail');
		if ($request->filled('keyword')) {
			$keywords['keyword'] = $this->stripCommasAndSpaces($keywords['keyword']);
			$pattern = implode('|',preg_split("#(,|\s)+#", $request->keyword));
			$query = $query->where('title','regexp','('.$pattern.')+');
		}
		if ($request->filled('min_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','>=',$request->min_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('max_price')) {
			$query = $query->where(function ($query) use ($request){
				$query->where('price','<=',$request->max_price)->orWhere('negotiate_price',1);
			})->orderBy('price','desc');
		}
		if ($request->filled('condition') && $request->condition !== '0') {
			$query = $query->where('condition_id',$request->condition);
		}
		if ($request->filled('country') && $request->country !== '0') {
			$query = $query->where('country_id',$request->country);
		}

		$result = $query->orderBy('created_at','desc')->paginate(12)->appends($keywords);
		return view('market/index-equipment',['market_category'=>'equipment','MarketItems'=>$result,'keywords'=>$keywords]);
	}
}
