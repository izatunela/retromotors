@extends('master')
@section('css')
	<link rel="stylesheet" href="{{asset('css/pages/user/profile.css')}}">	
	@yield('user/market-gallery css')
@endsection
@section('content')
<div class="row user-page-wrapper">
	<div class="col-12 col-sm-12 col-lg-auto">
		<div class="sidebar-container">
			<div class="sidebar-menu sidebar-desktop d-none d-md-flex">
				<a href="{{route('user-profile',Auth::user()->name)}}" class="menu-item profile"><i class="far fa-user sidebar-icon"></i>Profil</a>
				<a href="{{route('user-market',Auth::user()->name)}}" class="menu-item market"><i class="far fa-handshake sidebar-icon"></i>Oglasi</a>
				<a href="{{route('user-gallery',Auth::user()->name)}}" class="menu-item gallery"><i class="far fa-images sidebar-icon"></i>Galerija</a>
				{{-- <a href="#" class="menu-item inbox"><i class="far fa-comments sidebar-icon "></i>Poruke</a> --}}
				{{-- <a href="#" class="menu-item notifications"><i class="fas fa-flag-checkered sidebar-icon"></i>Obaveštenja</a> --}}
				<a href="{{route('user-settings',Auth::user()->name)}}" class="menu-item settings"><i class="fas fa-wrench sidebar-icon"></i>Podešavanja</a>
			</div>
			<ul class="profile-mobile-nav d-md-none">
				<li class="profile-nav-expander"><a class="menu-item profile"><span class="profile-active-page"></span><i class="drop-caret fas fa-caret-down"></i></a></li>
				<ul class="profile-nav-drop">
					<div class="dropdown-divider"></div>
					<li><a href="{{route('user-profile',Auth::user()->name)}}" class="menu-item profile"><i class="far fa-user sidebar-icon"></i>Profil</a></li>
					<div class="dropdown-divider"></div>
					<li><a href="{{route('user-market',Auth::user()->name)}}" class="menu-item market"><i class="far fa-handshake sidebar-icon"></i>Oglasi</a></li>
					<div class="dropdown-divider"></div>
					<li><a href="{{route('user-gallery',Auth::user()->name)}}" class="menu-item gallery"><i class="far fa-images sidebar-icon"></i>Galerija</a></li>
					{{-- <div class="dropdown-divider"></div> --}}
					{{-- <li><a href="#" class="menu-item inbox"><i class="far fa-comments sidebar-icon "></i>Poruke</a></li> --}}
					{{-- <div class="dropdown-divider"></div> --}}
					{{-- <li><a href="#" class="menu-item notifications"><i class="fas fa-flag-checkered sidebar-icon"></i>Obaveštenja</a></li> --}}
					<div class="dropdown-divider"></div>
					<li><a href="{{route('user-settings',Auth::user()->name)}}" class="menu-item settings"><i class="fas fa-wrench sidebar-icon"></i>Podešavanja</a></li>
				</ul>
			</ul>
		</div>
	</div>
	<div class="col-12 col-sm-12 col-lg">
		@yield('content')
	</div>
</div>
@overwrite
@section('js')
	<script>
		$(function(){
			let expander = $('.profile-nav-expander');
			let dropdown = $('.profile-nav-drop');
			const caret = $('.drop-caret')
			expander.on('click',function(){
				dropdown.toggle('fast');
				caret.toggleClass('drop-caret-r');
			});
		});
	</script>
	@yield('user-js')
@endsection