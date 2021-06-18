<div class="col-12 col-sm-12 col-lg-4">
	<div class="side-info">
		<div class="side-info-section seller">
			<h3 class="seller-name">{{$Item->user->name}}</h3>
			@php
				// $pcre = preg_match_all('/.{3}|.{1,2}/',$Item->contact_phone,$res);
				// $last = count($res[0]);
				// $tel = '';
				// foreach($res[0] as $ss){
				// 	if($res[0][$last-1] === $ss){

				// 		$tel .= $ss;
				// 	}
				// 	else
				// 		$tel .= $ss.'-';
				// }
			@endphp
			<a class="seller-phone" href="tel:{{$Item->contact_phone}}">{{$Item->contact_phone}}</a>
		</div>
		<div class="side-info-section price-sec">
			@if($Item->negotiate_price)
				<h4 class="price-negotiate">Dogovor</h4>
			@else
				<h4 class="price">&euro; {{number_format($Item->price,null,"",".")}}</h4>
				@if($Item->fixed_price)
					<p class="price-fixed">(cena je fiksna)</p>
				@else
					<p class="price-fixed">(cena nije fiksna)</p>
				@endif
			@endif
		</div>
		{{-- <div class="side-info-section contact"><h4>Kontakt</h4></div> --}}
		<div title="{{$Item->created_at->format('j.n.Y G:i:s')}}"><small>Postavljen: {{$Item->created_at->diffForHumans()}}</small></div>
		<div title="Broj pregleda"><small>Broj pregleda: {{$Item->views}}</small></div>
		{{-- <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button_count"></div> --}}
		<div class="social-share">
			<a href="" id="facebookShareLink" class="social-link">
				<img width="30" src="{{asset('img/fb.png')}}" alt="facebook">
			</a>
			<a href="viber://forward?text={{$Item->title}} - {{url()->current()}}" id="viber_share" class="social-link social-viber">
				<img width="30" src="{{asset('img/vibe.png')}}" alt="viber">
			</a>
		</div>
	</div>
</div>