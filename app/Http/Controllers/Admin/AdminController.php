<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRegistration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AdminController extends Controller
{
	public function __construct()
	{
		// $this->middleware('auth')-
	}
	public function index()
	{
		return view('admin/admin-master');
	}
	public function dashboard(Request $request)
	{
		if ($request->ajax()) {
			return response()->json(['html'=>view('admin/dashboard',['ext'=>'admin/admin-master-empty'])->render()]);
		}

		return view('admin/dashboard',['ext'=>'admin/admin-master']);
	}

	public function frontpage(Request $request)
	{
		if ($request->ajax()) {
			return response()->json(['html'=>view('admin/frontpage',['ext'=>'admin/admin-master-empty'])->render()]);
		}

		return view('admin/frontpage',['ext'=>'admin/admin-master']);
	}
	public function users(Request $request)
	{
		if ($request->ajax()) {
			return response()->json(['html'=>view('admin/users',['ext'=>'admin/admin-master-empty','users'=>User::all(),'inactive_users'=>User::onlyTrashed()->get()])->render()]);
		}

		return view('admin/users',['ext'=>'admin/admin-master','users'=>User::all(),'inactive_users'=>User::onlyTrashed()->get()]);
	}
	public function createUser(UserRegistration $request)
	{
		$user = new User;
		$user->name = $request->name;
		$user->name_slug = Str::slug($request->name);
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->confirmation_code = null;
		$user->role_id = 3;
		$user->status = 1;
		$user->save();

		return 'ok';
	}

	public function deleteUser(User $id)
	{
		// dd(session()->getId($id));
		// $id->status = false;
		// $id->save();
		$id->delete();
		// $file = \file_get_contents(storage_path('framework/sessions'));
		// return $file;
	}
	public function restoreUser(Request $req)
	{
		$user = User::onlyTrashed()->where('id',$req->id);
		$user->restore();
		$restored = User::find($req->id);
		$restored->getAutoMarketItems()->restore();
		$restored->getMotoMarketItems()->restore();
		$restored->getTruckMarketItems()->restore();
		$restored->getPartsMarketItems()->restore();
		$restored->getEquipmentMarketItems()->restore();
		$restored->getGalleryItems()->restore();

		$market_category_set = [
			$restored->getAutoMarketItems()->get(),
			$restored->getMotoMarketItems()->get(),
			$restored->getTruckMarketItems()->get(),
			$restored->getPartsMarketItems()->get(),
			$restored->getEquipmentMarketItems()->get()
		];
		foreach ($market_category_set as $market_items) {
			foreach ($market_items as $item) {
				$item->marketAllPhotos()->restore();
			}
		}
		$gallery_items = $restored->getGalleryItems()->get();
		foreach ($gallery_items as $item) {
			$item->galleryAllPhotos()->restore();
		}
	}

	public function create()
	{
		return view('auth/login/admin-login');
	}

	public function store(Request $request)
	{
		$remember = $request->remember ? true : false;
		if (Auth::attempt(['name' => $request['name'], 'password' => $request['password'], 'status' => true],$remember)) {
		    return redirect()->intended();
		}
		else{
			return back()->withInput()->withErrors(['Proverite ime i lozinku']);
		}
	}

	public function destroy()
	{
		auth()->logout();

		return redirect()->route('login');
	}
}
