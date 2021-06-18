@extends('user/index')
@section('user/market-gallery css')
	<link rel="stylesheet" href="{{asset('css/pages/user/user-market.css')}}">	
@endsection
@section('content')
	<h1 class="profile-sec-title">Moji oglasi</h1>
	<hr>
	<div class="market-gallery-wrapper">
		<div class="market-category-tabs">
			<ul class="nav nav-tabs">
				<li class="nav-item">
					<a class="nav-link user-market-nav-link automobile" data-category="automobile" data-route="{{route('user-market-items',[auth()->user()->name,'category'=>'automobile'])}}" href="#">Automobili [{{$user_items['auto']->count()}}]</a>
				</li>
				<li class="nav-item">
					<a class="nav-link user-market-nav-link motorcycle" data-category="motorcycle" data-route="{{route('user-market-items',[auth()->user()->name,'category'=>'motorcycle'])}}" href="#">Motocikli [{{$user_items['moto']->count()}}]</a>
				</li>
				<li class="nav-item">
					<a class="nav-link user-market-nav-link truck" data-category="truck" data-route="{{route('user-market-items',[auth()->user()->name,'category'=>'truck'])}}" href="#">Teškaši [{{$user_items['truck']->count()}}]</a>
				</li>
				<li class="nav-item">
					<a class="nav-link user-market-nav-link parts" data-category="parts" data-route="{{route('user-market-items',[auth()->user()->name,'category'=>'parts'])}}" href="#">Delovi [{{$user_items['parts']->count()}}]</a>
				</li>
				<li class="nav-item">
					<a class="nav-link user-market-nav-link equipment" data-category="equipment" data-route="{{route('user-market-items',[auth()->user()->name,'category'=>'equipment'])}}" href="#">Oprema [{{$user_items['equip']->count()}}]</a>
				</li>
			</ul>
		</div>
	</div>
@endsection
@section('user-js')
	<script type="text/javascript">
		$(function () {
			'use strict';

			$('.menu-item.market').addClass('active');
			$('.profile-active-page').html('<i class="far fa-handshake sidebar-icon"></i>Oglasi');
			$(document).on('click','.pagination .page-link',function(e){
				e.preventDefault();
				let pag=$(this).attr('href').split('page=')[1];
				loadPaginationPage(pag);
			});
			$('.market-gallery-wrapper .user-market-nav-link').on('click',function(e){
				e.preventDefault();
				let navBtn = $(this);
				let url = $(this).attr('data-route');
				if(!$(this).hasClass('active')){
					switchCategoryPage(url,navBtn);
				}
				$('.user-market-nav-link').removeClass('active');
				$(this).addClass('active');
			})
			$(window).on('popstate',function(){
				if(window.history.state){
					$('.market-content').remove();
					$('.market-gallery-wrapper').append(window.history.state.data);
					$('.user-market-nav-link').removeClass('active');
					$('.'+window.history.state.category.split(' ')[2]).addClass('active');
				}
			});
			function loadPaginationPage(pag){
				$.ajax({
					url:'?page='+pag,
					success: function(data){
						getData(data);
						// window.history.pushState({'data':data},'',url);
					}
				});
			}
			function switchCategoryPage(url='',navBtn=''){
				$.ajax({
					url:url,
					success: function(data){
						getData(data);
						window.history.pushState({'data':data,'category':navBtn.attr('class')},'',url);
					}
				});
			}
			function getData(data){
				$('.market-content').remove();
				$('.market-gallery-wrapper').append(data);
				$(".del-form").on('submit',function() {
					return confirm("Sigurno želite da izbrišete oglas?");
				});
				let settingsBtn = $('.settings-button-wrap');
				let dropdowns = $('.mobile-dropdown-wrap');
				settingsBtn.on('click',function () {
					if (!$(this).hasClass('previous-active')) {
						$('.previous-active > .mobile-item-settings-btn').removeClass('rotate-btn');
						$('.previous-active').removeClass('previous-active');
						$(this).addClass('previous-active');
					}

					$(this).children('.mobile-item-settings-btn').toggleClass('rotate-btn');
					
					let optionsDropdown = $(this).closest('.market-item').next('.mobile-dropdown-wrap');
					optionsDropdown.slideToggle('fast');
					dropdowns.not(optionsDropdown).slideUp('fast');
				});
			}
		});
	</script>
@endsection