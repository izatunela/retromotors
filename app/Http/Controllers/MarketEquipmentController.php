<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\MarketEquipment;
use App\Http\Requests\FormEquipment;
// use App\Http\Requests\FormMarket;
use App\Repositories\EquipmentRepository;


class MarketEquipmentController extends Controller
{
	protected $repository;

	public function __construct(EquipmentRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth')->except([
			'index','show'
		]);
	}

	public function index()
	{
		return view('market/index-equipment',$this->repository->getAllEquipmentItems());
	}

	public function create()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID]);
		$data = $this->repository->getCreateEquipmentFormData();
		return response()->json(['frmcntr'=>view('market/form-equipment')->render(),'cities'=>$data['cities']]);

	}

	public function store(FormEquipment $request)
	{
		$data = $this->repository->storeEquipmentItem($request);

		return response()->json($data);
	}

	public function show(MarketEquipment $item)
	{
		return view('market/item/item-equipment',$this->repository->showEquipmentItem($item));
		// return view('market/item/item-equipment',['Item'=>$item,'market_category'=>'equipment']);
	}

	public function edit()
	{
		$marketID = auth()->user()->id.uniqid(); // dodatni random na uuid
		session(['marketID'=>$marketID]);

		$marketEquipment = MarketEquipment::find(request()->id);
		$this->authorize('change',$marketEquipment);
		$data = $this->repository->editEquipmentItem(request()->id);

		return view('market/edit/edit-equipment',$data);
	}

	public function update(FormEquipment $request)
	{
		$marketEquipment = MarketEquipment::find(request()->id);

		$this->authorize('change',$marketEquipment);

		$data = $this->repository->updateEquipmentItem($request);

		return response()->json($data);

	}

	public function delete(MarketEquipment $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}
}
