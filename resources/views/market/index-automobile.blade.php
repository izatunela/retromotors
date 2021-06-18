@extends('market/index')
@section('index-category')
	<div class="border-top m-0"></div>
	@include('static/logos-auto')
	@include('market/partials/index-search-auto')
	@include('market/partials/index-market-items')
@endsection
@section('index-category-js')
<script>
	$(function () {
		$('.market-nav-el.automobile, .market-nav-el.automobile .market-nav-category').addClass('active');

		let model_select_field = $('#model');
		let brand_select_field = $('#brand');
		let brand = brand_select_field.val();

		if (brand === 'Svi proizvodjači' || brand === 'Ostalo') {
			model_select_field.attr('disabled',true);
		}
		brand_select_field.on('change',function() {
			brand = $('#brand').val();
			model_select_field.empty();
			model_select_field.prepend('<option selected value="Svi modeli">Svi modeli</option>');
			if (brand !== 'Ostalo' && brand !== 'Svi proizvodjači') {
				model_select_field.attr('disabled',false);
				$.ajax({
					headers: {
						'X-CSRF-TOKEN': $('input[name="_token"]').val()
						},
					type:'GET',
					url:'/vehicles/automobile/brand/models',
					data:{'brand':brand},
					success:function(data){
						$.each(data.models, function(index, model) {
							model_select_field.append('<option value ="'+model.name_slug+'">' + model.name + '</option>');
						});
					}
				});
			}
			else if (brand ==='Ostalo') {
				model_select_field.attr('disabled',true);
			}
			else if (brand === 'Svi proizvodjači') {
				model_select_field.attr('disabled',true);
			}
		});
	});
</script>
@endsection
