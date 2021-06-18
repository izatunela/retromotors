@extends('user/index')
@section('content')
	@include('static/alerts/alert-success')
	@include('static/alerts/alert-errors')
	<div class="profile-wrapper">
		<h1 class="name">{{$user->name}}</h1>
		<div class="profile-info">
			@if($user->city || $user->country)
				<div class="profile-details location">
					<span class="iconn"><i class="fas fa-map-marker-alt"></i></span>
					<span>{{$user->city}}</span>
					@if($user->city && $user->country)
						<span>,</span>
					@endif
					<span>{{$user->country}}</span>
				</div>
			@endif
			@if($user->phone)
				<div class="profile-details contact">
					<span class="iconn"><i class="fas fa-phone"></i></span>
					<span>{{decrypt($user->phone)}}</span>
				</div>
			@endif
		</div>
	</div>
	<div class="profile-wrapper">
		<div class="col-12 col-sm-6">
			{{Form::open(['method'=>'patch','url'=>route('user-profile-update')])}}
				{{-- <div class="form-group">
					@php
						$phone = $user->phone ?: null ;
					@endphp
					{{Form::label('phone', 'Telefon',['class' => 'label-profile'])}}
					{{Form::text('phone',$user->phone ? decrypt($user->phone): null,['class'=>'input-data input-info form-control','placeholder'=>''])}}
				</div> --}}
				<div class="form-group">
					{{Form::label('city', 'Grad',['class' => 'label-profile'])}}
					{{Form::text('city',$user->city,['class'=>'input-data input-info form-control','placeholder'=>''])}}
				</div>
				<div class="form-group">
					{{Form::label('country', 'Država',['class' => 'label-profile'])}}
					{{Form::text('country',$user->country,['class'=>'input-data input-info form-control','placeholder'=>''])}}
				</div>
			{{Form::submit('Sačuvaj', ['id'=>'submit-btn','class' => 'btn btn-primary'])}}
			{{Form::close()}}
		</div>
	</div>
@endsection
@section('user-js')
<script>
	$(function () {
		$('.menu-item.profile').addClass('active');
		$('.profile-active-page').html('<i class="far fa-user sidebar-icon"></i> Profil');
	});
</script>
@endsection