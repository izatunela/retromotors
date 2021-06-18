<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('guest')->except(['destroy','success']);
    }
    public function create()
    {
    	return view('auth/login/login');
    }

    public function success()
    {
    	return view('auth/login/success');
    }

    public function store(Request $request)
    {
        $remember = $request->remember ? true : false;
        if (filter_var($request->name,FILTER_VALIDATE_EMAIL)) {
            $username = 'email';
        } else {
            $username = 'name';
        }
        $user = User::where($username,$request->name)->withTrashed()->first();
        $user_deleted = isset($user->deleted_at);
        if ($user_deleted) {
            return back()->withInput()->withErrors(['Nalog nije aktivan']);
        }
    	if (Auth::attempt([$username => $request['name'], 'password' => $request['password'], 'status' => true],$remember)) {
    	    return redirect()->intended('/');
    	}
    	else{
    		return back()->withInput()->withErrors(['Proverite ime i lozinku']);
    	}
    }

    public function destroy()
    {
    	auth()->logout();

    	return redirect()->home();
    }

}
