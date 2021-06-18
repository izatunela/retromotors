@extends('auth/auth-master')
@section('title','Prijava')
@section('content')
	<h5 class="auth-title">Prijava</h5>
	<form class="login-form" action="{{route('login')}}" method="post">
	{{csrf_field()}}
		<input type="text" placeholder="Korisničko ime ili email adresa" name="name" value="{{old('name')}}" />
		{{-- <input type="email" placeholder="Email adresa" name="email" required /> --}}
		<input type="password" placeholder="Lozinka" name="password"/>
		<div class="auth-checkbox-wrap">
			{{Form::checkbox('remember', 1, null, ['id'=>'remember']) }}
			{{Form::label('remember', 'Zapamti me',['class' => ''])}}
		</div>
		<input type="submit" value="Prijavi se" name="login" class="btn btn-block auth-button" />
	</form>
	<a class="auth-opts" href="{{route('register')}}">Nemate nalog?</a><br>
	<a class="auth-opts" href="{{ route('password-forget-form') }}">Zaboravljena lozinka</a>
@endsection