@extends('auth/auth-master')
@section('title','Prijava')
@section('logo')
<img id="header-logo" src="{{asset('img/admin.png')}}" width="200" alt="">
@endsection
@section('content')
	
	<form class="form" action="{{route('login')}}" method="post">
	{{csrf_field()}}
		<input type="text" placeholder="Ime" name="name" value="{{old('name')}}"/>
		{{-- <input type="email" placeholder="Email adresa" name="email" required /> --}}
		<input type="password" placeholder="Lozinka" name="password"/>
		<div class="auth-checkbox-wrap">
			{{Form::checkbox('remember', 1, null, ['id'=>'remember','class' => '']) }}
			{{Form::label('remember', 'Zapamti me',['class' => ''])}}
		</div>
		<input type="submit" value="Prijavi se" name="login" class="btn btn-block auth-button" />
	</form>
@endsection