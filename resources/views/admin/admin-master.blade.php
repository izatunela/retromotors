<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Administrator | Retro Motors</title>
	<link href="{{asset('admin/css/plugins/footable/footable.core.css')}}" rel="stylesheet">
	<link rel="stylesheet" href="{{asset('admin/css/plugins/bootstrap.min.css')}}">
	{{-- <link rel="stylesheet" href="{{asset('admin/font-awesome/css/font-awesome.css')}}"> --}}
	<link rel="stylesheet" href="{{asset('fontz/css/all.css')}}">
	<!-- <link href="css/animate.css" rel="stylesheet"> -->
	<link href="{{asset('admin/css/adminstyle.css')}}" rel="stylesheet">
	@yield('css')
</head>

<body>
	<div id="wrapper">
		<nav class="navbar-default navbar-static-side" role="navigation">
			<div class="sidebar-collapse">
				<ul class="nav metismenu" id="side-menu">
					<li class="nav-header">
						<div class="dropdown profile-element">
								<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<span class="clear"> <span class="block m-t-xs"> <strong class="font-bold">{{auth()->user()->name??'admin'}}</strong>
								</span> <span class="text-muted text-xs block">Administrator <b class="caret"></b></span> </span> </a>
								<ul class="dropdown-menu animated fadeInRight m-t-xs">
									<li><a href="{{route('admin-logout')}}">Logout</a></li>
								</ul>
						</div>
						<div class="logo-element">
							RM
						</div>
					</li>
					<li id="admin-dashboard" class="link-element">
						<a class="admin-nav-link"  href="{{route('admin-dashboard')}}"><i class="fas fa-chart-line"></i> <span class="nav-label">RM statistika</span></a>
					</li>
					<li id="admin-frontpage" class="link-element">
						<a class="admin-nav-link" href="{{route('admin-frontpage')}}"><i class="fas fa-home"></i> <span class="nav-label">RM naslovna</span> </a>
					</li>
					<li id="admin-users" class="link-element">
						<a class="admin-nav-link" href="{{route('admin-users')}}"><i class="fas fa-users"></i> <span class="nav-label">RM korisnici</span> </a>
					</li>
					<li id="admin-market" class="link-element">
						<a href="#"><i class="fas fa-handshake"></i> <span class="nav-label">RM oglasi</span> </a>
						<ul class="nav nav-second-level collapse market">
							<li class="market-auto"><a class="admin-nav-link" href="{{route('admin-market-automobile')}}"><i class="fas fa-car-side"></i> Automobili</a></li>
							<li class="market-moto"><a class="admin-nav-link" href="{{route('admin-market-motorcycle')}}"><i class="fas fa-motorcycle"></i> Motocikli</a></li>
							<li class="market-truck"><a class="admin-nav-link" href="{{route('admin-market-truck')}}"><i class="fas fa-truck"></i> Teškaši</a></li>
							<li class="market-parts"><a class="admin-nav-link" href="{{route('admin-market-parts')}}"><i class="fas fa-wrench"></i> Delovi</a></li>
							<li class="market-equip"><a class="admin-nav-link" href="{{route('admin-market-equipment')}}"><i class="fas fa-air-freshener"></i> Oprema</a></li>
						</ul>
					</li>
					<li id="admin-gallery" class="link-element">
						<a class="admin-nav-link" href="{{route('admin-gallery')}}"><i class="fas fa-images"></i> <span class="nav-label">RM galerija</span> </a>
					</li>
					<li id="" class="">
						<a class="admin-nav-link" href="http://www.retromotorsdev.com"><i class="fas fa-images"></i> <span class="nav-label">dev.retromotors.rs</span> </a>
					</li>
				</ul>

			</div>
		</nav>

		<div id="page-wrapper" class="gray-bg">
			<div class="row border-bottom">
				<nav class="navbar navbar-static-top white-bg" role="navigation" style="margin-bottom: 0">
					<div class="navbar-header">
						<a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i class="fa fa-bars"></i> </a>
					</div>
					<ul class="nav navbar-top-links navbar-right">
						<li>
							<a href="{{route('admin-logout')}}">
								<i class="fas fa-sign-out-alt"></i> Log out
							</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="wrapper wrapper-content ">
				<div class="row">
					<div class="col-lg-12">
						<div class="content-wrap">
							{{-- <div id="loader">
								<i class="fas fa-cog"></i>
							</div> --}}
							<div class="content-section">
								@yield('content')
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="footer">
			
			</div>
		</div>
	</div>

	<script src="{{asset('admin/js/plugins/jquery-3.1.1.min.js')}}"></script>
	<script src="{{asset('admin/js/plugins/main.js')}}"></script>
	<script src="{{asset('admin/js/plugins/bootstrap.min.js')}}"></script>
	<script src="{{asset('admin/js/plugins/pace/pace.min.js')}}"></script>
	<script src="{{asset('admin/js/plugins/metisMenu/jquery.metisMenu.js')}}"></script>
	<script src="{{asset('admin/js/plugins/slimscroll/jquery.slimscroll.min.js')}}"></script>
	<script src="{{asset('admin/js/admin-master.js')}}"></script>
	
	@yield('js')
	<script src="{{asset('admin/js/plugins/footable/footable.all.min.js')}}"></script>
	{{-- <script src="{{asset('admin/js/users.js')}}"></script> --}}
</body>
</html>
