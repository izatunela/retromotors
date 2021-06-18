@extends('master')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/lightslider.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/photoswipe.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/default-skin/default-skin.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/pages/market/market-item.css')}}"/>
@endsection

@section('content')

<div class="wrap">
	<div class="row">
		<div class="col-xs-12 col-sm-8">
			<ul id="imageGallery">
				@foreach($Item->marketAllPhotos as $photo)
				<?php
					if($market_category === 'parts' || $market_category === 'equipment'){
						$title = $Item->title;
					}
					else{
						$title = $Item->manufacture_year.' '.$Item->brand->name.' ';
					};

					//$path = 'storage/Images/User_images/'.$Item->user->name.'/Market_images/'.$market_dir.'/'.$Item->id.'_'.$title.'/'.$photo->filename;
					$path = $photo->path.'/'.$photo->filename;
					$tn_path = $photo->path.'/tn-'.$photo->filename;
				?>
				<figure  data-thumb="{{asset($tn_path)}}" data-src="{{asset($tn_path)}}">
					<a data-size="{{getimagesize($path)[0]}}x{{getimagesize($path)[1]}}" itemprop="contentUrl" href="{{asset($path)}}">
					<img itemprop="thumbnail" class="item-img" src="{{asset($path)}}" />
					</a>
				</figure>
				@endforeach
			</ul>
		</div>
		<div class="col-xs-12 col-sm-4">
			<div class="side-info">
				<div class="side-info-section seller"><h3>Postavio: {{$Item->user->name}}</h3></div>
				<div class="side-info-section price">
					<h4>Cena: {{number_format($Item->price,null,""," ")}} &euro;</h4>
					@if($Item->fixed_price)
						<p>(fiksna)</p>
					@endif
				</div>
				<div class="side-info-section contact-seller"><h4>Kontakt</h4></div>
			</div>
		</div>
		@if($market_category !== 'parts' && $market_category !== 'equipment')
		<div class="col-xs-12 col-sm-12">
			<div class="title">
				<h5>{{-- {{$Item->manufacture_year}} {{$Item->brand}} {{$Item->model}} --}}{{$title}}</h5>
			</div>
			<br>
			<p>Specifikacije</p>
			{{-- <hr> --}}
			<table class="table table-sm">
			  <tbody>
				<tr>
					{{-- <th scope="row">Marka</th>
					<td>{{$Item->brand}}</td> --}}
					<th scope="row">Kilometraža</th>
					<td>{{number_format($Item->kilometerage,null,""," ")}} km / {{number_format($Item->kilometerage/1.609,null,""," ")}} mi </td>
					{{-- @if($market_category === 'automobile') --}}
					{{-- <th scope="row">Drzava</th> --}}
					{{-- <td>{{$Item->country}} <span class="flag"><img title="{{$Item->country}}" height="" width="26" src="{{asset('img/flags/2/'.$Item->country.'.png')}}" alt=""></span></td> --}}
					{{-- @endif --}}
					<th scope="row">Boja</th>
					<td>{{$Item->color}}</td>
				</tr>

				<tr>
				  <th scope="row">Godiste</th>
				  <td>{{$Item->manufacture_year}}</td>
				  <th scope="row">Menjač</th>
				  <td>{{$Item->transmission}}</td>
				</tr>
				<tr>
				  <th scope="row">Kubikaža</th>
				  <td>{{number_format($Item->volume,null,""," ")}} cm<sup>3</sup></td>
				  @if($market_category === 'automobile' || $market_category === 'truck')
					  <th scope="row">Gorivo</th>
					  <td>{{$Item->fuel}}</td>
				  @endif
				  @if($market_category === 'motorcycle')
					  <th scope="row">Broj cilindara</th>
					  <td>{{$Item->cylinder}}</td>
				  @endif
				</tr>
				<tr>
					<th scope="row">Snaga</th>
					<td>{{number_format($Item->power,null,""," ")}} kW / {{number_format($Item->power*1.35962,null,""," ")}} hp</td>

					@if($market_category === 'automobile')
						<th scope="row">Pogon</th>
						<td>{{$Item->drivetrain}}</td>
					@endif
					@if($market_category === 'truck')
						<th scope="row">Broj osovina</th>
						<td>{{$Item->axle}}</td>
					@endif
				</tr>
				<tr>
					@if($market_category === 'truck')
						<th scope="row">Nosivost</th>
						<td>{{$Item->capacity}}</td>
					@endif
				</tr>
				<tr>
					<th scope="row">Lokacija</th>
					<td>{{$Item->city}} <span class="flag"><img title="{{$Item->country->name}}" height="" width="26" src="{{asset('img/flags/2/'.$Item->country->name.'.png')}}" alt=""></span></td>
				</tr>
			  </tbody>
			</table>
		</div>
		@endif
		@if($market_category === 'parts' || $market_category === 'equipment')
		<div class="col-sm-12">
			<div class="title">
				<h5>{{$title}}</h5>
			</div>

		</div>
		<div class="col-xs-12 col-sm-4">
		<br>
		<p>Specifikacije</p>
		{{-- <hr> --}}
		<table class="table table-sm">
			<tbody>
				@if($market_category === 'parts')
				<tr>
					<th scope="row">Marka</th>
					<td>{{$Item->brand}}</td>
				</tr>
				@endif
				<tr>
					<th scope="row">Lokacija</th>
					<td>{{$Item->city}} <span class="flag"><img title="{{$Item->country->name}}" height="" width="26" src="{{asset('img/flags/2/'.$Item->country->name.'.png')}}" alt=""></span></td>
				</tr>
			</tbody>
		</table>
		</div>
		@endif
		<div class="col-xs-12 col-sm-12">
			<br>
			<p>Dodatni opis</p>
			<hr>
			<p>{{$Item->description}}</p>
		</div>
	</div>



	<!-- Root element of PhotoSwipe. Must have class pswp. -->
	<div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">

		<!-- Background of PhotoSwipe.
			 It's a separate element as animating opacity is faster than rgba(). -->
		<div class="pswp__bg"></div>

		<!-- Slides wrapper with overflow:hidden. -->
		<div class="pswp__scroll-wrap">

			<!-- Container that holds slides.
				PhotoSwipe keeps only 3 of them in the DOM to save memory.
				Don't modify these 3 pswp__item elements, data is added later on. -->
			<div class="pswp__container">
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
				<div class="pswp__item"></div>
			</div>

			<!-- Default (PhotoSwipeUI_Default) interface on top of sliding area. Can be changed. -->
			<div class="pswp__ui pswp__ui--hidden">

				<div class="pswp__top-bar">

					<!--  Controls are self-explanatory. Order can be changed. -->

					<div class="pswp__counter"></div>

					<button class="pswp__button pswp__button--close" title="Zatvori (Esc)"></button>

					<button class="pswp__button pswp__button--share" title="Podeli"></button>

					<button class="pswp__button pswp__button--fs" title="Prikaži preko celog ekrana"></button>

					<button class="pswp__button pswp__button--zoom" title="Uveličaj / Umanji"></button>

					<!-- Preloader demo http://codepen.io/dimsemenov/pen/yyBWoR -->
					<!-- element will get class pswp__preloader--active when preloader is running -->
					<div class="pswp__preloader">
						<div class="pswp__preloader__icn">
						  <div class="pswp__preloader__cut">
							<div class="pswp__preloader__donut"></div>
						  </div>
						</div>
					</div>
				</div>

				<div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
					<div class="pswp__share-tooltip"></div>
				</div>

				<button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)">
				</button>

				<button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)">
				</button>

				<div class="pswp__caption">
					<div class="pswp__caption__center"></div>
				</div>

			</div>

		</div>

	</div>

</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{asset('js/plugin/lightslider.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe-ui-default.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe-tn.js')}}"></script>
	<script type="text/javascript">
	   $(document).ready(function() {
		   $('#imageGallery').lightSlider({
			   gallery:true,
			   item:1,
			   loop:true,
			   thumbItem:10,
			   enableDrag: false,
			   pager:true,
			   currentPagerPosition:'middle',
			   mode:'fade'
		   });
		 });
	</script>
@endsection
