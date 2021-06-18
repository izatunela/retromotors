@extends('auth/auth-master')
@section('title','Zaboravljena lozinka')
@section('content')
	<h5 class="auth-title">Zaboravljena lozinka</h5>
	<form class="form-horizontal" method="POST" action="{{ route('password-forget-email') }}">
		{{ csrf_field() }}
		<input id="email" placeholder="Unesite email" type="text" name="email" value="{{ old('email') }}">
		<input type="submit" value="Potvrdi" name="login" class="btn btn-block auth-button" />
	</form>
		@if (session('pw-reset-sent'))
		    <div class="alert alert-success alert-wrap">
		        {{ session('pw-reset-sent') }}
		    </div>
		@endif
		<div><a class="auth-opts" href="{{route('login')}}"><i class="fas fa-angle-double-left"></i> Nazad</a></div>
@endsection