@extends('auth/auth-master')
@section('title','Obnavljanje lozinke')
@section('content')
	<h5 class="auth-title">Obnavljanje lozinke</h5>
	<form class="form" action="{{route('password-reset')}}" method="post" autocomplete="off">
		{{csrf_field()}}
		<input type="hidden" name="token" value="{{ $token }}">

		<input type="text" placeholder="Email adresa" name="email"  value="{{old('email')}}" autocomplete="on" />
        <input id="password" placeholder="Nova lozinka" type="password" name="password" >
        <input id="password-confirm" placeholder="Potvrdi lozinku" type="password" name="password_confirmation" >
		<input type="submit" value="Potvrdi" name="login" class="btn btn-block auth-button" />
	</form>
@endsection