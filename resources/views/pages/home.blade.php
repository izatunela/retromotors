@extends('master')
@section('title','Naslovna')
@section('og-type','website')
@section('og-image',asset("img/retromotorslogo.png"))
@section('og-image-width','640')
@section('og-image-height','480')
@section('css')
	<link rel="stylesheet" href="{{asset('css/pages/home/home.css')}}">
@endsection
@section('content')
{{-- <div id="homepage">
	@php
		if ($auto->count()) {
			$Lauto = $auto->get()->last();
			$Lapath = asset('storage/'.$Lauto->marketPhotoThumbnail->path.'/tn-'.$Lauto->marketPhotoThumbnail->filename);
			$Latitle = $Lauto->title;
		}
		else{
			$Lapath = asset('mockups/1.jpg');
			$Latitle = 'Naslov';
		}

		if ($moto->count()) {
			$Lmoto = $moto->get()->last();
			$Lmpath = asset('storage/'.$Lmoto->marketPhotoThumbnail->path.'/tn-'.$Lmoto->marketPhotoThumbnail->filename);
			$Lmtitle = $Lmoto->title;
		}
		else{
			$Lmpath = asset('mockups/5.jpg');
			$Lmtitle = 'Naslov';
		}

		if ($truck->count()) {
			$Ltruck = $truck->get()->last();
			$Ltpath = asset('storage/'.$Ltruck->marketPhotoThumbnail->path.'/tn-'.$Ltruck->marketPhotoThumbnail->filename);
			$Lttitle = $Ltruck->title;
		}
		else{
			$Ltpath = asset('mockups/19.jpg');
			$Lttitle = 'Naslov';
		}

		if ($gallery->count()) {
			$Lgallery = $gallery->get()->last();
			$Lgpath = asset('storage/'.$Lgallery->galleryPhotoThumbnail->path.'/tn-'.$Lgallery->galleryPhotoThumbnail->filename);
			$Lgtitle = $Lgallery->title;
		}
		else{
			$Lgpath = asset('mockups/25.jpg');
			$Lgtitle = 'Naslov';
		}
		
		
	@endphp
	<div class="row ">
		<div class="col-12 col-sm">
			<div id="myCarousel" class="carousel carousel-fade  slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
					<li data-target="#myCarousel" data-slide-to="1"></li>
					<li data-target="#myCarousel" data-slide-to="2"></li>
					<li data-target="#myCarousel" data-slide-to="3"></li>
				</ol>

				<div class="carousel-inner">
					<div class="carousel-item active">
						<a href="#">
							<img class="home-section-img" src="{{$Lapath}}" alt="" >
							<div class="carousel-caption">
								<h3>{{$Latitle}}</h3>
								<p>Lorem ipsum dolor sit amet</p>
							</div>
						</a>
					</div>

					<div class="carousel-item">
						<a href="#">
							<img class="home-section-img" src="{{$Lmpath}}" alt="" >
							<div class="carousel-caption">
								<h3>{{$Lmtitle}}</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quod, amet est tempora eligendi, doloribus provident quisquam aliquam ducimus tempore laborum nemo porro! Ducimus deleniti voluptatibus, dolorem illum perspiciatis, nesciunt temporibus.</p>
							</div>
						</a>
					</div>

					<div class="carousel-item">
						<a href="#">
							<img class="home-section-img" src="{{$Ltpath}}" alt="" >
							<div class="carousel-caption">
								<h3>{{$Lttitle}}</h3>
								<p>Lorem ipsum</p>
							</div>
						</a>
					</div>

					<div class="carousel-item">
						<a href="#">
							<img class="home-section-img" src="{{$Lgpath}}" alt="" >
							<div class="carousel-caption">
								<h3>{{$Lgtitle}}</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. </p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
		<div class="col-12 col-sm-4">
			<div class="row home-section-row no-gutters">
				<div class="home-section home-section-small">
					<a href="#">
						<img class="home-section-img" src="{{$Lapath}}">
						<div class="header-wrap">
							<div class="home-section-header header-small">
								<p class="home-section-header-paragraph">{{$Latitle}}</p>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row home-section-row no-gutters">
				<div class="home-section home-section-small">
					<a href="#">
						<img class="home-section-img" src="{{$Lmpath}}">
						<div class="header-wrap">
							<div class="home-section-header header-small">
								<p class="home-section-header-paragraph">{{$Lmtitle}}</p>
							</div>
						</div>
					</a>
				</div>
			</div>
			<div class="row home-section-row no-gutters">
				<div class="home-section home-section-small">
					<a href="#">
						<img class="home-section-img" src="{{$Ltpath}}">
						<div class="header-wrap">
							<div class="home-section-header header-small">
								<p class="home-section-header-paragraph">{{$Lttitle}}</p>
							</div>
						</div>
					</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="row">
		<div class="col-12 col-sm-4">
			<div class="home-section">
				<a href="#">
					<img class="home-section-img" src="{{$Lgpath}}">
					<div class="home-section-header">
						<h5 class="home-section-header-title">{{$Lgtitle}}</h5>
						<p class="home-section-header-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-12 col-sm-4">
			<div class="home-section">
				<a href="#">
					<img class="home-section-img" src="{{$Lgpath}}">
					<div class="home-section-header">
						<h5 class="home-section-header-title">{{$Lgtitle}}</h5>
						<p class="home-section-header-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</a>
			</div>
		</div>
		<div class="col-12 col-sm">
			<div class="home-section">
				<a href="#">
					<img class="home-section-img" src="{{$Lgpath}}">
					<div class="home-section-header">
						<h5 class="home-section-header-title">{{$Lgtitle}}</h5>
						<p class="home-section-header-paragraph">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmodtempor incididunt ut labore et dolore magna aliqua.</p>
					</div>
				</a>
			</div>
		</div>
	</div>
	<div class="spacer"></div>
</div> --}}
<div class="about-page">
	<div class="about-bg">
		<div class="about-f"></div>
		<div class="about-wrap">
			<h1 class="about-title">Dobrodošli na <br class="br-mobile">Retro Motors</h1>
			<p class="about-paragraph">Sajt retromotors.rs je zamišljen kao platforma za povezivanje ljubitelja starih i klasičnih motornih vozila. Nismo ograničeni 			definicijom oldtajmera, i tu smo da objedinimo sve ono što bi se moglo podvesti pod pojam "retro" vozila, kao što i sam naziv sajta kaže.
				<br><br>
				Sajt je u velikoj meri i dalje u razvoju. Sugestije i kritike su dobrodošle i možete ih poslati na <span style="color:#fb0000">office@retromotors.rs</span>.
			</p>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$('a.nav-link.homepage').addClass('active')

	$('.carousel').carousel({
		// interval:false,
	});
</script>
@endsection