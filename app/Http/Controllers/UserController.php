<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\MarketAutomobile;
use App\Models\MarketMotorcycle;
use App\Models\MarketTruck;
use App\Models\MarketParts;
use App\Models\MarketEquipment;
use App\Models\EmailChange;
use App\Http\Requests\UserChangePassword;
use App\Http\Requests\UserChangeEmail;
use App\Http\Requests\UserProfile;
use App\Events\UserChangeEmailEvent;
use DB;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		// $this->user = User::find(auth()->user()->id);

		// $this->middleware(function ($request, $next) {
  //           $this->user = User::find(auth()->user()->id);

  //           return $next($request);
  //       });
	}

	// public function currentUser()
	// {
	// 	return $user = User::find(auth()->user()->id);
	// }

	public function index()
	{
		$user = auth()->user();

		return view('user/index',['user'=>$user]);
	}

	public function profile($user)
	{
		$auth_user = auth()->user();
		if ($user->name === $auth_user->name) {
			return view('user/profile',['user'=>$auth_user]);
		}

		return abort(403);
	}
	public function getChangeEmailForm()
	{
		return view('user/email',['email'=>auth()->user()->email]);
	}
	public function changeEmail(UserChangeEmail $request)
	{
		$token = Str::random(30);
		$user = User::find(auth()->user()->id);
		$user->confirmation_code = $token;
		$user->save();
		$temp_email = new EmailChange;
		$temp_email = EmailChange::firstOrNew(['user_id'=>$user->id]);
		$temp_email->user_id = $user->id;
		$temp_email->alt_email = $request->email;
		$temp_email->confirmation_code = $token;
		$temp_email->save();
		event(new UserChangeEmailEvent($request->email,$user->confirmation_code));
		return back()->with('status','Poslali smo aktivacioni link na Vaš novi email');
	}
	public function changeEmailConfirm($confirmation_code)
	{
		$email_tmp = EmailChange::where('confirmation_code',$confirmation_code)->firstOrFail();
		$user = User::where('confirmation_code',$confirmation_code)->firstOrFail();

		$old_email = $user->email;
		$user->email = $email_tmp->alt_email;
		$user->confirmation_code = null;
		$user->save();
		$email_tmp->alt_email = $old_email;
		$email_tmp->confirmation_code = null;
		$email_tmp->save();
		$user->sendEmailChangedNotification();
		return redirect('login');
	}
	public function getChangePasswordForm()
	{
		return view('user/password',[]);
	}
	public function changePassword(UserChangePassword $request)
	{
		$user = User::find(auth()->user()->id);
		$user->password = bcrypt($request->password);
		$user->save();
		$user->sendPasswordChangedNotification();

		return back()->with('status','Lozinka uspešno promenjena');
	}
	public function profileUpdate(UserProfile $request)
	{
		$user = User::find(auth()->user()->id);
		if($request->filled('phone')){
			$user->phone = encrypt($request->phone);
		}
		else{
			$user->phone = null;
		}
		$user->city = $request->city;
		$user->country = $request->country;
		$user->save();

		return back()->with('status','Profil uspešno ažuriran');
	}

	public function market()
	{
		$user = User::find(auth()->user()->id);
		$items = $user->userMarketItems();

		return view('user/market',['user_items'=>$items]);
	}

	public function getMarketItemsByCategory(Request $request,$user,$category)
	{
		$MarketCategory = '\\App\\Market'.ucfirst($category);
		$items = $MarketCategory::with('user')->where('user_id',$user->id)->orderBy('created_at','desc')->paginate(6);
		if($request->ajax())
			return response()->json(view('user/market-items',['market_collection'=>$items,'market_category'=>$category])->render());
		else
			return redirect('user/'.$user->name.'/market');
	}

	public function gallery()
	{
		$user = User::find(auth()->user()->id);
		$items = $user->galleryItems();

		return view('user/gallery',['gallery_collection'=>$items]);
	}

	public function inbox()
	{
		return view('user/inbox');
	}

	public function notifications()
	{
		return view('user/notifications');
	}

	public function settings()
	{
		return view('user/settings');
	}

	// public function delete(Request $request,User $user)
	// {

	// }


}
