<div class="logo-wrap">
	<a href="{{route('home')}}">
		<img id="header-logo" src="{{asset('img/retromotorslogo.png')}}" alt="">
	</a>
</div>
<nav id="" class="navbar navbar-expand-sm navbar-dark " role="navigation">
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
	    <span class="navbar-toggler-icon"></span>
	</button>
	<div class="collapse navbar-collapse" id="navbarText">
		<ul class="navbar-nav w-100 main-nav">
			<li class="nav-item"><a class="nav-link homepage" href="{{route('home')}}">Naslovna</a></li>
			<li class="nav-item"><a class="nav-link nav-link-market" href="{{route('market-automobile')}}">Oglasi</a></li>
			<li class="nav-item"><a class="nav-link nav-link-gallery" href="{{route('gallery-index')}}">Galerija</a></li>
			{{-- <li class="nav-item"><a class="nav-link" href="#">Forum</a></li> --}}
			{{-- <li class="nav-item"><a class="nav-link nav-link-about" href="{{route('about')}}">O nama</a></li> --}}
			@if(Request::is('market/*') && !Request::is('market/edit/*'))
			<li  id="market-create" class="nav-item market-create-desk">
				<a href="{{route('market-create')}}" class="">POSTAVI OGLAS</a>
			</li>
			@endif
		</ul>
	</div>
		{{-- <div class="navbot"></div> --}}
</nav>
@if(Request::is('market/*') && !Request::is('market/edit/*'))
<div  id="market-create" class="nav-item market-create-mobile">
	<a href="{{route('market-create')}}" class="">POSTAVI OGLAS</a>
</div>
@endif
