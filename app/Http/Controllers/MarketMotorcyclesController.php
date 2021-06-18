<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarketMotorcycle;
use App\Models\BrandsMotorcycle;
use App\Http\Requests\FormMotorcycle;
// use App\Http\Requests\FormMarket;
use App\Repositories\MotorcycleRepository;


class MarketMotorcyclesController extends Controller
{
	protected $repository;

	public function __construct(MotorcycleRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth')->except([
			'index','show'
		]);
	}

	public function index(Request $request)
	{
		return view('market/index-motorcycle',$this->repository->getMotorcycleItems($request));
	}

	public function create()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID]);
		$data = $this->repository->getCreateMotorcycleFormData();

		return response()->json(['frmcntr'=>view('market/form-motorcycle')->render(),'cities'=>$data['cities'],'brands'=>$data['brands']]);
	}

	public function store(FormMotorcycle $request)
	{
		$data = $this->repository->storeMotorcycleItem($request);

		return response()->json($data);
	}

	public function show(MarketMotorcycle $item)
	{
		// return view('market/item/item-motorcycle',['Item'=>$item,'market_category'=>'motorcycle']);
		return view('market/item/item-motorcycle',$this->repository->showMotorcycleItem($item));
	}

	public function edit()
	{
		$marketID = auth()->user()->id.uniqid(); // dodatni random na uuid
		session(['marketID'=>$marketID]);

		$marketMotorcycle = MarketMotorcycle::find(request()->id);
		$this->authorize('change',$marketMotorcycle);
		$data = $this->repository->editMotorcycleItem(request()->id);

		return view('market/edit/edit-motorcycle',$data);
	}

	public function update(FormMotorcycle $request)
	{
		$marketMotorcycle = MarketMotorcycle::find(request()->id);

		$this->authorize('change',$marketMotorcycle);

		$data = $this->repository->updateMotorcycleItem($request);

		return response()->json($data);

	}

	public function delete(MarketMotorcycle $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}
}
