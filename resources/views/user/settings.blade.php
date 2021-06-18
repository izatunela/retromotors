@extends('user/index')

@section('content')
	<div class="profile-wrapper profile-settings">
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<label class="label-profile">Korisničko ime</label>
					<p>{{Auth::user()->name}}</p>
					{{-- {{Form::label('name', 'Korisničko ime',['class' => ''])}} --}}
					{{-- {{Form::text('name',Auth::user()->name,['class'=>'input-data input-info form-control','placeholder'=>''])}} --}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<label class="label-profile">Email</label>
					<p>{{Auth::user()->email}}</p>
					<p><a href="{{route('user-email-change-form',['user'=>auth()->user()->name])}}" class=""><span><i class="fas fa-envelope"></i></span> Promeni email</a></p>
					{{-- {{Form::label('email', 'Email',['class' => ''])}} --}}
					{{-- {{Form::text('email',Auth::user()->email,['class'=>'input-data input-info form-control','placeholder'=>''])}} --}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-12">
				<div class="form-group">
					<label class="label-profile">Lozinka</label>
					<p><a href="{{route('user-password-change-form',['user'=>auth()->user()->name])}}" class=""><span><i class="fas fa-key"></i></span> Promeni lozinku</a></p>
					{{-- {{Form::label('email', 'Email',['class' => ''])}} --}}
					{{-- {{Form::text('email',Auth::user()->email,['class'=>'input-data input-info form-control','placeholder'=>''])}} --}}
				</div>
			</div>
		</div>
	</div>
@endsection
@section('user-js')
<script>
	$(function () {
		$('.menu-item.settings').addClass('active');
		$('.profile-active-page').html('<i class="fas fa-wrench sidebar-icon"></i>Podešavanja');
	});
</script>
@endsection