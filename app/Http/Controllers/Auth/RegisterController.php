<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Events\UserRegisteredEvent;
use App\Http\Requests\UserRegistration;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
// use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
	/*
	|--------------------------------------------------------------------------
	| Register Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users as well as their
	| validation and creation. By default this controller uses a trait to
	| provide this functionality without requiring any additional code.
	|
	*/

	// use RegistersUsers;

	/**
	 * Where to redirect users after registration.
	 *
	 * @var string
	 */
	// protected $redirectTo = '/';

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('guest');
	}

	public function registerForm()
	{

		return view('auth/registration/register');
	}

	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $request
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	// protected function validator(Request $request)
	// {
	// 	return Validator::make($request->all(), [
	// 		'name'		 => 'required|string|unique:user|max:30|min:2',
	// 		'email'		 => 'required|string|email|unique:user|max:255',
	// 		'password'	 => 'required|string|min:1|confirmed',
	// 	]);
	// }
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $request
	 * @return User
	 */
	protected function store(UserRegistration $request)
	{
		$user = new User;
		$user->name_slug = Str::slug($request->name);
		$user->name = $request->name;
		$user->email = $request->email;
		$user->password = bcrypt($request->password);
		$user->confirmation_code = Str::random(30);
		$user->role_id = 3;
		$user->save();
		// $url = url('confirm/'.$user->confirmation_code);

		event(new UserRegisteredEvent($user,$user->confirmation_code));

		return back()->with(['registration-success'=>1,'email'=>$user->email]);
	}

	protected function confirm($confirmation_code)
	{
		$user = User::where('confirmation_code',$confirmation_code)->firstOrFail();
		$user->status = true;
		$user->confirmation_code = null;
		$user->save();

		return redirect('login'); //obavestenje da je aktiviran nalog
	}
}
