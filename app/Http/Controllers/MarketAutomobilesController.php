<?php

namespace App\Http\Controllers;

// use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarketAutomobile;
use App\Http\Requests\FormAutomobile;
// use App\Http\Requests\FormMarket;
use App\Repositories\AutomobileRepository;

class MarketAutomobilesController extends Controller
{
	/**
	 * AutomobileRepository instance
	 *
	 * @var AutomobileRepository
	 **/
	protected $repository;


	public function __construct(AutomobileRepository $repository)
	{
		$this->repository = $repository;

		$this->middleware('auth')->except([
			'index','show'
		]);
	}

	public function index(Request $request)
	{
		return view('market/index-automobile',$this->repository->getAutomobileItems($request));
	}

	public function create()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID]);
		$data = $this->repository->getCreateAutomobileFormData();

		return response()->json(['frmcntr'=>view('market/form-automobile')->render(),'cities'=>$data['cities'],'brands'=>$data['brands']]);
	}

	public function store(FormAutomobile $request)
	{
		$data = $this->repository->storeAutomobileItem($request);

		return response()->json($data);
	}

	public function show(MarketAutomobile $item)
	{
		// return view('market/item/item-automobile',['Item'=>$item,'market_category'=>'automobile']);
		return view('market/item/item-automobile',$this->repository->showAutomobileItem($item));
	}

	public function edit()
	{
		$marketID = auth()->user()->id.uniqid();
		session(['marketID'=>$marketID]);

		$marketAutomobile = MarketAutomobile::find(request()->id);
		$this->authorize('change',$marketAutomobile);
		$data = $this->repository->editAutomobileItem(request()->id);

		return view('market/edit/edit-automobile',$data);
	}

	public function update(FormAutomobile $request)
	{
		$marketAutomobile = MarketAutomobile::find(request()->id);

		$this->authorize('change',$marketAutomobile);

		$data = $this->repository->updateAutomobileItem($request);

		return response()->json($data);
	}

	public function delete(MarketAutomobile $item)
	{
		$this->authorize('change',$item);

		$item->delete();

		return redirect()->back();
	}

}#controller
