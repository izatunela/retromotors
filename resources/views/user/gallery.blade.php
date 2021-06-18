@extends('user/index')
@section('user/market-gallery css')
	<link rel="stylesheet" href="{{asset('css/pages/user/user-gallery.css')}}">	
@endsection
@section('content')
	<h1 class="profile-sec-title">Moja galerija</h1>
	<hr>
	<div class="market-gallery-wrapper">
	 	@if($gallery_collection->isEmpty())
	 		<div class="items-empty">Nemate predmete u galeriji</div>
	 	@endif
		@foreach($gallery_collection as $item)
			@php
			if (is_null($item->galleryPhotoThumbnail)) {
				$img_path = asset('img/noimg.png');
			}
			else{
				$img_path = asset('storage/'.$item->galleryPhotoThumbnail->path.'/tn-'.$item->galleryPhotoThumbnail->filename);
			}

			@endphp
			<div class="gallery-item">
				<div class="img-sec ">
					<a href="{{route('gallery-item',['id'=>$item->id,'title'=>$item->title_slug])}}">
						<img src="{{$img_path}}">
					</a>
				</div>
				<div class="title-sec">
					<a href="{{route('gallery-item',['id'=>$item->id,'title'=>$item->title_slug])}}"><span class="title">{{$item->title}}</span></a>
					<p class="description">{{$item->description}}</p>
				</div>
				<div class="date-sec">
					<p class="datetime" title="{{$item->created_at}}">{{$item->created_at->diffForHumans()}}</p>
				</div>
				{{-- <div class="views-sec">
					<p title="Broj pregleda"><i class="fas fa-eye"> </i> <span>{{$item->views}}</span></p>
				</div> --}}
				<div class="actions">
					{{Form::open(['method'=>'post','url'=>route('gallery-edit',['title'=>$item->title_slug]),'id'=>'','class'=>''])}}
						{{Form::hidden('id',$item->id)}}
						<div class="actions-btn">
							<span><i class="fas fa-pencil-alt"></i></span>
							{{Form::submit('Izmeni', ['id'=>'','class' => 'edit-button'])}}
						</div>
					{{Form::close()}}
					{{Form::open(['method'=>'delete','url'=>route('gallery-delete',['item'=>$item->id]),'id'=>'','class'=>'del-form'])}}
						<div class="actions-btn">
							<span><i class="fas fa-trash"></i></span>
							{{Form::submit('Izbriši', ['id'=>'','class' => 'edit-button'])}}
						</div>
					{{Form::close()}}
				</div>
				<div class="mobile-item-settings-container d-md-none">
					<div class="settings-button-wrap" data-dropd-link = "{{$item->id}}">
						<i class="mobile-item-settings-btn fas fa-cog"></i>
					</div>
				</div>
			</div>
			<div class="mobile-dropdown-wrap d-md-none" data-dropd-link = "{{$item->id}}">
				<ul class="mobile-item-options">
					{{-- <div class="dropdown-divider"></div> --}}
					<li class="item-option">
						<div class="mobile-date-sec">
							<span class="datetime" title="{{$item->created_at->format('j.n.Y G:i:s')}}">{{$item->created_at->diffForHumans()}}</span>
						</div>
					{{-- </li> --}}
					{{-- <li class="item-option"> --}}
						{{-- <div class="mobile-views-sec">
							<span title="Broj pregleda">pregleda: <span>{{$item->views}}</span></span>
						</div> --}}
					</li>
					<div class="dropdown-divider"></div>
		
					<li class="item-option">
						{{Form::open(['method'=>'post','url'=>route('gallery-edit',['title'=>$item->title_slug]),'id'=>'','class'=>''])}}
							{{Form::hidden('id',$item->id)}}
							<div class="option-btn">
								<span><i class="fas fa-pencil-alt"></i></span>
								{{Form::submit('Izmeni', ['id'=>'','class' => 'edit-button'])}}
							</div>
						{{Form::close()}}
					</li>
					<div class="dropdown-divider"></div>
					<li class="item-option">
						{{Form::open(['method'=>'delete','url'=>route('gallery-delete',['item'=>$item->id]),'id'=>'','class'=>'del-form'])}}
							<div class="option-btn">
								<span><i class="fas fa-trash"></i></span>
								{{Form::submit('Izbriši', ['id'=>'','class' => 'edit-button'])}}
							</div>
						{{Form::close()}}
					</li>
					<div class="dropdown-divider"></div>
		
				</ul>
			</div>
		@endforeach
		<div class="pagination-wrap">	
			{{ $gallery_collection->links() }}
		</div>
	</div>
@endsection
@section('user-js')
	<script type="text/javascript">
		$(function () {
			'use strict';

			$(".del-form").on('submit',function() {
			    return confirm("Sigurno želite da izbrišete oglas?");
			});
			$('.menu-item.gallery').addClass('active');
			$('.profile-active-page').html('<i class="far fa-images sidebar-icon"></i>Galerija');

			let settingsBtn = $('.settings-button-wrap');
			let dropdowns = $('.mobile-dropdown-wrap');
			settingsBtn.on('click',function () {
				if (!$(this).hasClass('previous-active')) {
					$('.previous-active > .mobile-item-settings-btn').removeClass('rotate-btn');
					$('.previous-active').removeClass('previous-active');
					$(this).addClass('previous-active');
				}

				$(this).children('.mobile-item-settings-btn').toggleClass('rotate-btn');
				
				let optionsDropdown = $(this).closest('.gallery-item').next('.mobile-dropdown-wrap');
				optionsDropdown.slideToggle('fast');
				dropdowns.not(optionsDropdown).slideUp('fast');
			});
		});
	</script>
@endsection