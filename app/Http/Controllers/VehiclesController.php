<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrandsAutomobile;
use App\Models\ModelsAutomobile;
use App\Models\BrandsMotorcycle;
use App\Models\BrandsTruck;

class VehiclesController extends Controller
{
	public function __construct()
	{

	}

	public function getAutomobileBrands()
	{
		// $brands = BrandsAutomobile::all();
		$brands = BrandsAutomobile::pluck('name','id');
		// foreach ($brands as $key => $value) {
		// 	$brands_list[]= $value;
		// }

		return response()->json(['brands'=>$brands]);
	}

	public function getAutomobileModels(Request $request)
	{
		$brand = $request->brand;

		$automobile = BrandsAutomobile::where('name_slug',$brand)->first();
		$model_list = $automobile->getAutoModels()->get(['name_slug','name']);
		// $model_list = ModelsAutomobile::where('brands_automobile_id',$automobile->id)->pluck('name','name_slug');
		// dd($model_list);
		$model_list->push(['name_slug'=>'ostalo','name'=>'Ostalo']);

		return response()->json(
		    [
		        'models'=>$model_list
            ]
        );
	}

	public function getMotorcycleBrands()
	{
		$brands = BrandsMotorcycle::pluck('name');
		// $brands = BrandsMotorcycle::all();
		// foreach ($brands as $key => $value) {
		// 	$brands_list[]= $value;
		// }

		return response()->json(['brands'=>$brands]);
	}

	public function getTruckBrands()
	{
		$brands = BrandsTruck::pluck('name');
		// $brands = BrandsTruck::all();
		// foreach ($brands as $key => $value) {
		// 	$brands_list[]= $value;
		// }

		return response()->json(['brands'=>$brands]);
	}

	public function getBrandsByVehicleCategory()
	{
		$data = [
		    'auto'=>BrandsAutomobile::pluck('name','id'),
            'moto'=>BrandsMotorcycle::pluck('name','id'),
            'truck'=>BrandsTruck::pluck('name')
        ];
		return response()->json($data);
	}

}
