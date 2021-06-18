<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use DB;
use Auth;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
    public function showLinkRequestForm()
    {
        return view('auth.passwords.submitrequest');
    }
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(
            [
                'email'             =>  'required|email|exists:user'
            ],
            [
                'email.required'    =>  'Email adresa je obavezna',
                'email.email'       =>  'Email adresa nije validna',
                'email.exists'      =>  'Email adresa nije validna',
                // 'email.unique'      =>  'Vec je podnet zahtev',
            ]
        );
        $token = Str::random(60);
        $user = User::where('email',$request->email)->first();
        DB::table('password_resets')->insert(
            [
                'email'         => $request->email,
                'token'         => $token,
                'created_at'    => date('Y-m-d H:i:s')
            ]
        );

        return $user->sendPasswordResetEmail($token);
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function reset(Request $request)
    {
        $request->validate(
            [
                'email'     =>  'bail|required|email|exists:user',
                'password'  =>  'bail|required|min:8|confirmed',
                'token'     =>  'bail|required|exists:password_resets',
            ],
            [
                'email.required'        =>  'Email adresa je obavezna',
                'email.email'           =>  'Email adresa nije validna',
                'email.exists'          =>  'Email adresa nije validna',
                'password.required'     =>  'Lozinka je obavezna',
                'password.min'          =>  'Lozinka mora imati najmanje 8 karaktera',
                'password.confirmed'    =>  'Lozinke se ne poklapaju',
                'token.required'        =>  'Došlo je do greške.Pokušajte ponovo',
                'token.exists'          =>  'Došlo je do greške.Pokušajte ponovo',
            ]
        );

        $tokendb = DB::table('password_resets')
            ->where('token', $request->token)
            ->first();

        if ($tokendb->created_at <= Carbon::now()->subMinutes(60)) {
            DB::table('password_resets')
                ->where('token', $request->token)
                ->delete();
            return redirect()
                ->route('password-forget-form')
                ->withErrors(['Prethodni zahtev je istekao.Pokušajte ponovo']);
        }

        $user = User::where('email',$tokendb->email)->first();

        if ($request->email !== $user->email || !$user) {
            return back()->withErrors(['Email adresa nije validna']);
        }

        $user->password = bcrypt($request->password);
        $user->save();
        $user->sendPasswordChangedNotification();
        Auth::login($user);
        DB::table('password_resets')->where('email', $user->email)->delete();
        return redirect('/');
    }
}
