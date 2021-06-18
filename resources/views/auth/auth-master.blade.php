<!doctype html>
<html lang="{{ config('app.locale') }}">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>@yield('title') - Retromotors</title>
		<link rel="icon" href="{{asset('img/gear1.png')}}">
		<link rel="stylesheet" href="{{asset('css/plugin/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{asset('fontz/css/all.css')}}">
		<link rel="stylesheet" href="{{asset('css/pages/auth/auth-pages.css')}}">

	</head>
	<body>
		<div class="container">
			<div class="row justify-content-center auth-user-form">
				<div class="col-8 col-sm-6 col-lg-4 col-xl-3">
					<div class="logo-wrap">
						<a href="{{route('home')}}">
							<img id="header-logo" src="{{asset('img/retromotorslogo.png')}}" alt="">
						</a>
						@yield('logo')
					</div>
					@yield('content')
					@include('static/alerts/alert-errors')
				</div>
			</div>
		</div>
		<script src="{{asset('js/plugin/jquery.min.js')}}"></script>
		<script src="{{asset('js/plugin/popper.min.js')}}"></script>
		<script src="{{asset('js/plugin/bootstrap.min.js')}}"></script>
	</body>
</html>
