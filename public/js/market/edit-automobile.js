$(function () {
	let model_select_field 		= $('#model');
	let custom_brand_container 	= $('#custom-brand');
	let custom_model_container 	= $('#custom-model');
	let brand 					= $('#brand').val();
	let model 					= $('#model').val();

	if (brand === 'Ostalo') {
		model_select_field.prepend('<option selected hidden value="Ostalo">Ostalo</option>')
	}
	else{
		custom_brand_container.detach();
		custom_model_container.detach();
	}
	if (model === 'Ostalo') {
		custom_model_container.appendTo('#model-container');
	}
	else{
		custom_model_container.detach();
	}
	$('#brand').change(function() {
		let brand = $('#brand').val();
		$('#model').empty();
		$('#model').attr('disabled',false);
		if (brand === 'Ostalo') {
			custom_brand_container.appendTo('#brand-container');
			custom_model_container.appendTo('#model-container');
			model_select_field.prepend('<option selected hidden value="Ostalo">Ostalo</option>')
		}
		else if (brand !=='Ostalo') {
			custom_brand_container.detach();
			custom_model_container.detach();
			$.ajax({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
					},
				type:'GET',
				url:'../../../vehicles/automobile/brand/models',
				data:{'brand':brand},
				success:function(data){
					$.each(data.models, function(index, model) {
						$('#model').append('<option value ="'+model+'">' + model + '</option>');
					});
				}
			});
		}
	});
	$('#model').change(function() {
		let model = $('#model').val();
		if (model === 'Ostalo') {
			custom_model_container.appendTo('#model-container');
		}
		else if(model !== 'Ostalo'){
			custom_model_container.detach();
		}
	});
});