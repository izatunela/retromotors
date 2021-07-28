<footer class="footer">
	<div class="container">
		<div class="row">
			<div class="col">
				<div class="logo-footer">
					<a href="{{route('home')}}">
						<img id="header-logo" src="{{asset('img/retromotorslogo.png')}}" alt="">
					</a>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col">
				<div class="footer-links">
					<a href="{{route('home')}}">Naslovna</a>
					·
					<a href="{{route('market-automobile')}}">Oglasi</a>
					·
					<a href="{{route('gallery-index')}}">Galerija</a>
					{{-- · --}}
					{{-- <a href="#">Forum</a> --}}
					·
					<a href="{{route('about')}}">O nama</a>
				</div>
			</div>
			{{-- <div class="col">
				<div class="">
					<p>Pratite nas</p>
					<div class="footer-icons">
						<a href="#"><i class="fab fa-facebook"></i></a>
						<a href="#"><i class="fab fa-instagram"></i></a>
					</div>
				</div>
			</div> --}}
		</div>
		<div class="row">
			<div class="col">
				<div class="footer-contact">
					<div>Kontakt</div>
					{{-- <i class="far fa-envelope"></i> --}}
					<span>office@retromotors.rs</span>
				</div>
			</div>
		</div>
		<div class="footer-icons">
			<a href="https://www.facebook.com/retromotors.rs/" target="_blank"><i class="fab fa-facebook"></i></a>
			<a href="https://www.instagram.com/retromotors.rs/" target="_blank"><i class="fab fa-instagram"></i></a>
		</div>
		<div class="footer-divide"></div>
		<div class="footer-copyright">
			<span class="footer-company-name">Retro Motors &copy; 2021</span>
			<div class="footer-company-name">Developed by Marko Ivanovic</div>
		</div>
	</div>
</footer>
