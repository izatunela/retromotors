@extends('auth/auth-master')
@section('title','Registracija')
@section('content')
	<h5 class="auth-title">Registracija</h5>
	<form class="reg-form" action="{{url('register')}}" method="post">
	{{csrf_field()}}
		{{-- <label for="name">Korisničko ime</label> --}}
		<input type="text" placeholder="Korisničko ime" id="name" name="name" value="{{old('name')}}" />
		{{-- <label for="email">Korisničko ime</label> --}}
		<input type="text" placeholder="Email adresa" id="email" name="email" value="{{old('email')}}" />
		{{-- <label for="password">Korisničko ime</label> --}}
		<input type="password" placeholder="Lozinka" id="password" name="password"/>
		<input type="password" placeholder="Potvrdi lozinku" id="password-c" name="password_confirmation"/>
		<input type="submit" value="Registruj se" name="register" class="btn btn-block auth-button" />
	</form>
	<a class="auth-opts"href="{{route('login')}}"><b>Već imate nalog?</b></a>
	@if (session('registration-success'))
		<div class="alert alert-success alert-wrap">
			{{-- {{ session('registration-success') }} --}}
			Registracija uspešna!
		</div>
		<div class="alert alert-primary alert-wrap">
			Poslali smo aktivacioni link na: <br><b>{{session('email')}}</b>
		</div>
	@endif
@endsection