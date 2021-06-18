@extends('market/index')
@section('index-category')
	<div class="border-top m-0"></div>
	@include('static/logos-truck')
	@include('market/partials/index-search-truck')
	@include('market/partials/index-market-items')
@endsection
@section('index-category-js')
<script>
	$(function () {
		$('.market-nav-el.truck, .market-nav-el.truck .market-nav-category').addClass('active');
	});
</script>
@endsection