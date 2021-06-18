@extends('master')
@section('title',$gallery_item->title)
@section('og-type','article')
@section('og-description','some description')
@section('og-image',asset($gallery_item->galleryPhotoThumbnail->path.$gallery_item->galleryPhotoThumbnail->filename))
@section('og-image-width','640')
@section('og-image-height','480')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/lightslider.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/photoswipe.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/plugin/default-skin/default-skin.css')}}"/>
	<link rel="stylesheet" type="text/css" href="{{asset('css/pages/gallery/gallery-item.css')}}"/>
@endsection
@section('content')
<div class="wrap">
	<div class="row">
		<div class="col-12">
			<input type="hidden" name="gallery_id" value={{$gallery_item->id}}>
			{{-- <input type="hidden" name="uauth" value={{Auth::check()?1:0}}> --}}
			<div id="imageGallery" class="">
				@foreach($gallery_item->galleryAllPhotos as $photo)
				<?php
					$title = ucfirst(implode(' ',explode('-',$gallery_item->title)));
					$path = $photo->path.'/'.$photo->filename;
					$tn_path = $photo->path.'/tn-'.$photo->filename;
				?>
				<figure id="figure-wrap" data-thumb="{{asset($tn_path)}}" data-src="{{asset($tn_path)}}">
					<a class="" data-size="{{getimagesize($path)[0]}}x{{getimagesize($path)[1]}}" itemprop="contentUrl" href="{{asset($path)}}">
						<img title="" class="item-img" itemprop="thumbnail" src="{{asset($path)}}" alt="">
						<div class="zoom-wrap">
							<i id="zoom-overlay" class="fas fa-search-plus"></i>
						</div>
					</a>
				</figure>
				@endforeach
			</div>
		</div>
		<div class="col-12" >
			<div class="caption">
				<div class="title-wrap">
					<h5 class="title">{{$title}}</h5>
					{{-- <a class="title-username" href="#">{{$gallery_item->user->name}}</a> --}}
					<a class="title-username" href="#">{{$gallery_item->user()->withTrashed()->first()->name}}</a>
				</div>
				<br>
				<div class="social-share">
					<a href="" id="facebookShareLink" class="social-link">
						<img width="30" src="{{asset('img/fb.png')}}" alt="facebook">
					</a>
					<a href="viber://forward?text={{$title}} - {{url()->current()}}" id="viber_share" class="social-link social-viber">
						<img width="30" src="{{asset('img/vibe.png')}}" alt="viber">
					</a>
				</div>
				<div class="gallery-description">
					<h6>Opis</h6>
					<hr>
					<p>{{$gallery_item->description}}</p>
				</div>
			</div>
			{{-- <hr> --}}
			{{-- <div class="fb-share-button" data-href="{{Request::url()}}" data-layout="button_count"></div> --}}
			<hr>
			<div id="comments-section">
				<div class="comments-head">
					<h6>Komentari [<small class="comments-count">{{$gallery_item->comments->count()}}</small>]:</h6>
				</div>
				@if ($gallery_item->comments->count()>0)
					<div class="comments-wrap">
						<div class="gallery-loader">
							<i class="fas fa-cog"></i>
						</div>
						<div class="comments-container">
						</div>
					</div>
				@else
					<div class="comments-wrap">
						<div class="comments-container">
							<div class="comments-section-empty">
								<span>Trenutno nema komentara.</span>
							</div>
						</div>
					</div>
				@endif
				<div class="comment-create">
					{{-- <div class="user-avatar-wrap">
						@auth
							<a href="#" class="user-avatar"><span>{{ auth()->user()->name[0] }}</span></a>
						@endauth
						@guest
							<a href="#" class="user-avatar"><img src="{{asset('img/gear.png')}}" alt=""></a>
						@endguest
					</div> --}}
					@auth
						<form id="submit-comment-form" action="{{route('gallery-create-comment',$gallery_item->id)}}" method="POST">
							{{csrf_field()}}
							<textarea class="comment-body-input" name="body" rows="3" placeholder="Ostavite komentar...">{{session('comment')}}</textarea>
							<div class="comment-button-wrap">
								<button  class="create-comment-btn">Postavi</button>
								<span class="loader-sm"><i class="fas fa-cog"></i></span>
								<div class="post-success"><i class="fas fa-check"></i></div>
								<div class="post-fail"><i class="fas fa-times"></i><span class="err-msg"></span></div>
							</div>
						</form>
					@endauth
					@guest
						{{-- <form action="{{route('login')}}" method="GET">
							{{csrf_field()}}
							<textarea class="guest-comment-body" name="body" rows="3" placeholder="Ostavite komentar... (Morate biti prijavljeni)"></textarea>
							<button  class="create-comment-btn guest-comment-btn">Postavi</button>
							<div class="post-fail"><i class="fas fa-times"></i><span class="err-msg"></span></div>

						</form> --}}
						<a style="width:100%" href="{{route('login')}}">
							<textarea class="guest-comment-body" name="body" rows="3" placeholder="Ostavite komentar... (Morate biti prijavljeni)"></textarea>
							<button  class="create-comment-btn guest-comment-btn">Postavi</button>
						</a>
					@endguest
				</div>
			</div>
		</div>
	</div>
	@include('static/photoswipe-slider')
</div>
@endsection
@section('js')
	<script type="text/javascript" src="{{asset('js/plugin/lightslider.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe-ui-default.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/plugin/photoswipe-tn.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/gallery/gallery-item.js')}}"></script>
@endsection
