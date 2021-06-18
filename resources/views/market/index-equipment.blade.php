@extends('market/index')
@section('index-category')
	<div class="border-top m-0"></div>
	@include('market/partials/index-search-equip')
	@include('market/partials/index-market-items')
@endsection
@section('index-category-js')
<script>
	$(function () {
		$('.market-nav-el.equipment, .market-nav-el.equipment .market-nav-category').addClass('active');
	});
</script>
@endsection