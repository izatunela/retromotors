@extends('market/index')
@section('index-category')
	<div class="border-top m-0"></div>
	@include('market/partials/index-search-parts')
	@include('market/partials/index-market-items')
@endsection
@section('index-category-js')
<script>
	$(function () {
		$('.market-nav-el.parts, .market-nav-el.parts .market-nav-category').addClass('active');

		$('#brand').attr('disabled',true);
		$.ajax({
			method:'GET',
			url: '/vehicles/all/brands',
			success:function (data) {
				$('.vehicle_cat').change(function() {
					$('#brand').empty();
					$('#brand').prepend('<option selected value="Sve marke">Sve marke</option>');
					$('#brand').attr('disabled',false);
					var cat = $(this).val();
					if (cat === '1') {
						$.each(data.auto, function(index, brand) {
							$('#brand.select-info').append('<option value ="'+index+'">' + brand + '</option>');
						});
					}
					else if (cat === '2') {
						$.each(data.moto, function(index, brand) {
							$('#brand.select-info').append('<option value ="'+index+'">' + brand + '</option>');
						});
					}
					else if (cat === '3') {
						$.each(data.truck, function(index, brand) {
							$('#brand.select-info').append('<option value ="'+index+'">' + brand + '</option>');
						});
					}
				});
			}
		});
	});
</script>
@endsection