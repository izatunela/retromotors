@extends('master')
@section('css')
	<link rel="stylesheet" href="{{asset('css/plugin/photoswipe.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugin/default-skin/default-skin.css')}}">
	<link rel="stylesheet" href="{{asset('css/pages/gallery/gallery-index.css')}}">
@endsection
@section('content')

{{-- <div class="row"> --}}
	{{-- <div class="col"> --}}
		<h1 class="gallery-head my-4 text-center text-lg-center">GALERIJA</h1>
		<p class="gallery-head-text text-center">Sekcija Galerija je zamišljena kao mesto gde bi ljubitelji podelili sa ostalima slike svojih, ali i tuđih ljubimaca.</p>
		<div id="imageGallery">
			{{-- <div class="container"> --}}
				<a href="{{route('gallery-create')}}" class="gallery-create-btn btn">Dodaj u Galeriju</a>
				<hr>
				@foreach($gallery->chunk(4) as $chunk)
				<div class="row">
					@foreach($chunk as $item)
						<div class="image-wrap col-6 col-sm-6 col-lg-3">
						<?php
							if (is_null($item->galleryPhotoThumbnail)) {
								$img_path = asset('img/noimg.png');
							}
							else{
								$img_path = asset('storage/'.$item->galleryPhotoThumbnail->path.'/tn-'.$item->galleryPhotoThumbnail->filename);
							}
						?>
							<div class="image-inner">
							{{-- <figure class="slifa" data-thumb="{{asset($path)}}" data-src="{{asset($path)}}"> --}}
								<a  href="{{route('gallery-item',['id'=>$item->id,'title'=>$item->title_slug])}}">
									{{-- <img class="item-img" src="{{asset('storage/Images/User_images/'.$item->user->name.'/Gallery_images/'.$item->id.'_'.$item->title_slug.'/tn-'.$item->galleryPhotoThumbnail['filename'])}}" alt=""> --}}
									<img class="item-img" src="{{$img_path}}" alt="">
									<div class="caption">
										<div class="caption-content">
											{{-- <div class="caption-title"> --}}
												<p class="caption-title">{{$item->title}}</p>
											{{-- </div> --}}
											{{-- <div class="caption-user"> --}}
												<p class="caption-user">{{$item->user()->withTrashed()->first()->name}}</p>
												{{-- <p class="caption-user">{{$item->user->name}}</p> --}}
											{{-- </div> --}}
										</div>
									</div>
								</a>

								{{-- <figcaption itemprop="caption description"><a href="{{route('gallery-item',['id'=>$item->id])}}"><h3>Image caption  1</h3></a></figcaption> --}}
							{{-- </figure> --}}
							</div>
						</div>
					@endforeach
				</div>
				@endforeach
			{{-- </div> --}}
		</div>
		<div class="pagination-wrap">
			{{ $gallery->links() }}
		</div>
	{{-- </div> --}}
{{-- </div> --}}
@endsection

@section('js')

@endsection
