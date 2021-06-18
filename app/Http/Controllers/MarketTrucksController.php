<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarketTruck;
use App\Http\Requests\FormTruck;
// use App\Http\Requests\FormMarket;
use App\Repositories\TruckRepository;

class MarketTrucksController extends Controller
{
	protected $repository;

	public function __construct(TruckRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth')->except([
			'index','show',
		]);
	}

	public function index(Request $request)
	{
		return view('market/index-truck',$this->repository->getTruckItems($request));
	}

	public function create()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID,'name'=>0]);
		$data = $this->repository->getCreateTruckFormData();

		return response()->json(['frmcntr'=>view('market/form-truck')->render(),'cities'=>$data['cities'],'brands'=>$data['brands']]);
	}

	public function store(FormTruck $request)
	{
		$data = $this->repository->storeTruckItem($request);

		return response()->json($data);
	}

	public function show(MarketTruck $item)
	{
		return view('market/item/item-truck',$this->repository->showTruckItem($item));
		// return view('market/item/item-truck',['Item'=>$item,'market_category'=>'truck']);
	}

	public function edit()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID]);

		$marketTruck = MarketTruck::find(request()->id);
		$this->authorize('change',$marketTruck);
		$data = $this->repository->editTruckItem(request()->id);

			return view('market/edit/edit-truck',$data);

	}

	public function update(FormTruck $request)
	{
		$marketTruck = MarketTruck::find(request()->id);

		$this->authorize('change',$marketTruck);

		$data = $this->repository->updateTruckItem($request);

		return response()->json($data);
	}

	public function delete(MarketTruck $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}
}
