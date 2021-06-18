@if($MarketItems->total()>0)
	<div class="market-container">
		<div class="row">
			<div class="col">
				<small>Ukupno oglasa: {{$MarketItems->total()}}</small>
				<hr>
			</div>
		</div>
		<div class="row">
				@foreach($MarketItems as $item)
				{{-- @foreach ($chunk as $item) --}}
				@php
					if (is_null($item->marketPhotoThumbnail)) {
						$path = asset('img/noimg.png');
					}
					else{
						$path = asset('storage/'.$item->marketPhotoThumbnail->path.'/tn-'.$item->marketPhotoThumbnail->filename);
					}
					@endphp
				<div class="col-6 col-sm-6 col-md-4 col-lg-3 col-mobile-padding">
					<div class="market-item ">
						<div class="item-thumbnail">
							<a href="{{route('market-'.$market_category.'-item',['title'=>$item->title_slug,'item'=>$item->id])}}">
                                @if(!is_null($item->marketPhotoThumbnail) && file_exists(public_path($item->marketPhotoThumbnail->path.'/tn-'.$item->marketPhotoThumbnail->filename)))
                                <img class="thumbnail-img" src="{{$path}}" alt=""/>
                                @else
                                <img class="thumbnail-img" src="{{$path}}" alt=""/>
                                @endif
                            </a>
                            <div class="description">
                                <div class="flag"><img title="{{$item->country->name}}" height="" width="24" src="{{asset("img/flags/".$item->country->name.".png")}}" alt=""></div>
                                <div class="title">
                                    <h1><a href="{{route('market-'.$market_category.'-item',['item'=>$item->id,'title'=>$item->title_slug])}}">{{$item->title}}</a></h1>
                                </div>
                            </div>
                            <div class="price">
                                @if($item->negotiate_price)
                                <h2><strong>Dogovor</strong></h2>
                                @else
                                <h2><strong><span id="">&euro;</span> {{number_format($item->price,null,"",".")}}</strong></h2>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
				{{-- @endforeach --}}
				@endforeach
			</div>
	</div>
	<div class="pagination-wrap">
		{{ $MarketItems->links() }}
	</div>
@else
	<div class="col">
		<div id="no-result">
			Nema rezultata
		</div>
	</div>
@endif
