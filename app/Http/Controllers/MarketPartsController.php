<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarketParts;
// use App\Http\Requests\FormMarket;
use App\Repositories\PartsRepository;
use App\Http\Requests\FormParts;


class MarketPartsController extends Controller
{
	protected $repository;

	public function __construct(PartsRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth')->except([
			'index','show',
		]);
	}

	public function index()
	{
		return view('market/index-parts',$this->repository->getAllPartsItems());
	}

	public function create()
	{
		$marketID = auth()->user()->id.uniqid(); // dodatni random na uuid
		session(['marketID'=>$marketID]);
		$data = $this->repository->getCreatePartsFormData();


		return response()->json(['frmcntr'=>view('market/form-parts')->render(),'cities'=>$data['cities'],'auto'=>$data['auto'],'moto'=>$data['moto'],'truck'=>$data['truc']]);
	}


	public function store(FormParts $request)
	{
		$data = $this->repository->storePartsItem($request);

		return response()->json($data);
	}

	public function show(MarketParts $item)
	{
		return view('market/item/item-parts',$this->repository->showPartsItem($item));
		return view('market/item/item-parts',['Item'=>$item,'brand'=>$this->repository->getPartsBrandName($item),'market_category'=>'parts']);
	}

	public function edit()
	{
		$marketID = auth()->user()->id.uniqid(); // dodatni random na uuid
		session(['marketID'=>$marketID]);

		$marketParts = MarketParts::find(request()->id);
		$this->authorize('change',$marketParts);
		$data = $this->repository->editPartsItem(request()->id);

		return view('market/edit/edit-parts',$data);
	}

	public function update(FormParts $request)
	{
		$marketParts = MarketParts::find(request()->id);

		$this->authorize('change',$marketParts);

		$data = $this->repository->updatePartsItem($request);

		return response()->json($data);
	}

	public function delete(MarketParts $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}
}
