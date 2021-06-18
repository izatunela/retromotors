@extends('market/index')
@section('index-category')
	<div class="border-top m-0"></div>
	@include('static/logos-moto')
	@include('market/partials/index-search-moto')
	@include('market/partials/index-market-items')
@endsection
@section('index-category-js')
<script>
	$(function () {
		$('.market-nav-el.motorcycle, .market-nav-el.motorcycle .market-nav-category').addClass('active');
	});
</script>
@endsection