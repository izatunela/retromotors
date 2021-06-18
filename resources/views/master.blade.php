<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="application-name" content="Retro Motors">
		<meta name="keywords" content="retromotors,retro motors,retro,motors,retro automobili,retro vozila,oldtajmer,oldtajmeri,oldtajmeri prodaja,oldtajmeri kupovina,oldtajmeri forum,oldtajmeri srbija,automobili srbija,oldtajmeri slovenija,oldtajmeri hrvatska,oldtajmeri crna gora,oldtajmeri bosna i hercegovina,oldtajmeri makedonija,automobili,automobili oldtajmeri,auto,automobili prodaja,motori,motori prodaja,motocikli,motocikli prodaja,motori oldtajmer,kamioni,stari kamioni,oldtajmer kamioni,kamioni prodaja,vozila,klasik,klasicna vozila,classic,classic cars,oldtimers,automobile,motorcycle,truck,vehicle,staro vozilo,stara,vozila,stara vozila,muzej vozila,restauracija,resauracija vozila,restaurirana vozila,alfa romeo,audi,bmw,benelli,ferrari,ford,mercedes,lancia,renault,volkswagen,porsche,mustang,suzuki,honda,ducati,java,tomos,zastava,">
		<meta property="og:url"           		content="{{Request::url()}}" />
		<meta property="og:type"          		content="@yield('og-type','website')" />
		<meta property="og:title"         		content="@yield('title','Retro Motors')" />
		<meta property="og:image"     			content="@yield('og-image',asset("img/retromotorslogo.png"))" />
		<meta property="og:image:url"     		content="@yield('og-image',asset("img/retromotorslogo.png"))" />
		<meta property="og:image:secure_url"	content="@yield('og-image',asset("img/retromotorslogo.png"))" />
		<meta property="og:image:width"     	content="@yield('og-image-width','640')" />
		<meta property="og:image:height"     	content="@yield('og-image-height','480')" />
		<title>@yield('title') - Retro Motors</title>
		<link rel="icon" href="{{asset('img/gear1.png')}}">
		<link rel="stylesheet" href="{{asset('css/plugin/select2.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/plugin/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('css/plugin/jquery-ui.min.css')}}">
		<link rel="stylesheet" href="{{asset('fontz/css/all.css')}}">
		<link rel="stylesheet" href="{{asset('css/pages/master/style.css')}}">
		@yield('css')
	</head>
	<body>
		<div id="master-wrap">
			<div id="top-panel">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-10 offset-sm-1">
							<div id="btns-wrap">
								<div id="socials">
									<a href="https://www.facebook.com/retromotors.rs/" target="_blank"><i class="fab fa-facebook"></i></a>
									<a href="https://www.instagram.com/retromotors.rs/" target="_blank"><i class="fab fa-instagram"></i></a>
								</div>
								<div id="auth">
									@if(!Auth::check())
										<a href="{{url('login')}}"><span>Prijava</span> <i class="fas fa-sign-in-alt"></i></a>
									@endif
									@if(Auth::check())
										<div class="rm-dropdown">
											<div href="#" role="button" id="dropdownBtn"  aria-haspopup="true" aria-expanded="false"><span>{{Auth::user()->name}}</span> <i class="fas fa-bars"></i></div>
											<div class="rm-dropdown-menu" aria-labelledby="dropdownBtn">
												<a class="item" href="{{route('user-profile',['user'=>Auth::user()->name])}}"><i class="fas fa-user"></i> <span>Profil</span></a>
												<a class="item" href="{{route('user-market',['user'=>Auth::user()->name])}}"><i class="fas fa-handshake"></i> <span>Moji oglasi</span></a>
												<a class="item" href="{{route('user-gallery',['user'=>Auth::user()->name])}}"><i class="fas fa-images"></i> <span>Moja galerija</span></a>
												{{-- <a class="item" href="#"><i class="fas fa-comments"></i> <span>Moje poruke</span></a> --}}
												<a class="item" href="{{route('logout')}}"><i class="fas fa-sign-out-alt"></i> <span>Odjavite se</span></a>
											</div>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1 p-mob-0">
						@include('static/header')
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1">
						<div id="content">
							@yield('content')
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12 col-sm-10 offset-sm-1">
						@include('static/footer')
					</div>
				</div>
			</div>
		</div> {{-- main --}}
		<script src="{{asset('js/plugin/jquery.min.js')}}"></script>
		<script src="{{asset('js/plugin/jquery-ui.min.js')}}"></script>
		<script src="{{asset('js/plugin/jquery-ui-touch-punch.min.js')}}"></script>
		<script src="{{asset('js/plugin/popper.min.js')}}"></script>
		<script src="{{asset('js/plugin/select2.full.min.js')}}"></script>
		<script src="{{asset('js/plugin/bootstrap.min.js')}}"></script>
		@yield('js')
		<script>
			$(function(){
				$("#facebookShareLink").on("click",function(){
					var fbpopup = window.open("https://www.facebook.com/sharer/sharer.php?u="+window.location.href, "pop", "width=600, height=400, scrollbars=no");
					console.log('wew')
					return false;
				});
				$('[data-toggle="tooltip"]').tooltip();
				let current = window.location.pathname;
				$('a.nav-link').each(function(){
					let $this = $(this);
					if($this.attr('href').includes(current) && current !== '/'){
						$this.addClass('active');
					}
				});
				if (current.includes('market') && !current.includes('user') && !current.includes('market/edit')) {
					$('.nav-link-market').addClass('active');
				}
				if (current.includes('gallery') && !current.includes('user') && !current.includes('gallery/edit')) {
					$('.nav-link-gallery').addClass('active');
				}
				$('#dropdownBtn').on('click',function (e) {
					e.stopPropagation();
					$('.rm-dropdown-menu').toggle();
				});
				$(document).on('click',function () {
					$('.rm-dropdown-menu').css('display','none');
				});
			});
		</script>
		<script>
			var Retromotors = Retromotors || {};
		</script>
	</body>
</html>
