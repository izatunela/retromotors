@extends('master')
@section('css')
	<link rel="stylesheet" type="text/css" href="{{asset('css/pages/market/market-index.css')}}"/>
@endsection
@section('content')
<div class="market-nav">
	<div class="market-nav-el automobile">
		<a href="{{route('market-automobile')}}">
			<div class="market-img-wrap">
				<img class="category-img auto" src="{{asset('img/marketcategory/automobile.png')}}" alt="">
			</div>
			<h1 class="market-nav-category">Automobili</h1>
		</a>
	</div>
	<div class="market-nav-el motorcycle">
		<a href="{{route('market-motorcycle')}}">
			<div class="market-img-wrap">
				<img class="category-img" src="{{asset('img/marketcategory/motorcycle.png')}}" alt="">
			</div>
			<h1 class="market-nav-category">Motocikli</h1>
		</a>
	</div>
	<div class="market-nav-el truck">
		<a href="{{route('market-truck')}}">
			<div class="market-img-wrap">
				<img class="category-img truck" src="{{asset('img/marketcategory/truck.png')}}" alt="">
			</div>
			<h1 class="market-nav-category">Teškaši</h1>
		</a>
	</div>
	<div class="market-nav-el parts">
		<a href="{{route('market-parts')}}">
			<div class="market-img-wrap">
				<img class="category-img parts" src="{{asset('img/marketcategory/parts.png')}}" alt="">
			</div>
			<h1 class="market-nav-category">Delovi</h1>
		</a>
	</div>
	<div class="market-nav-el equipment">
		<a href="{{route('market-equipment')}}">
			<div class="market-img-wrap">
				<img class="category-img equipment" src="{{asset('img/marketcategory/equipment.png')}}" alt="">
			</div>
			<h1 class="market-nav-category">Oprema</h1>
		</a>
	</div>
</div>
@yield('index-category')
@endsection
@section('js')
@yield('index-category-js')
<script>
	$(function(){
		function formatState(state) {
			if (state.id === '0') {
				return state.text;
			}
			var baseUrl = "/img/flags";
			var $state = $(
				`
						<img width="25" src="${baseUrl}/${$(state.element).html()}.png" class="img-flag" />
						<span class="select2-country-title">${state.text}</span>
					`
			);
			return $state;
		}
		$('.select-info').select2({
			containerCssClass: ':all:',
		});
		$('#country').select2({
			containerCssClass: ':all:',
            templateResult: formatState
		});
	});
</script>
@endsection
