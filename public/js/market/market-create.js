$(document).ready(function () {
	'use strict';
	function formatStateMarketCategory(state) {
		if (!state.id) {
			return state.text;
		}
		var baseUrl = "/img/marketcategory";
		var $state = $(
			`<img width="28" src="${baseUrl}/${state.element.value}.png" class="img-flag" />
				<span class="market-category-form">${state.text}</span>
			`
		);
		return $state;
	}
	function formatStateMarketCategorySelected(state) {
		if (!state.id) {
			return state.text;
		}
		var baseUrl = "/img/marketcategory";
		var $state = $(
			`<span class="select2-custom-template-wrap">
				<img style="object-fit:contain" height="25" width="25" src="${baseUrl}/${state.element.value}.png" class="img-flag" />
					<span class="market-category-form">${state.text}</span>
			</span>
			`
		);
		return $state;
	}
	$('select').on('select2:open', function () {
		$('.select2-search input').prop('focus', 0);
	});
	$('.category').select2({
		templateResult: formatStateMarketCategory,
		templateSelection: formatStateMarketCategorySelected,
		containerCssClass: ':all:',
	});
	$('.category > option:first-child').attr('disabled',true);
	$('.category').on('change',function() {
		var category = $(this).val();
		$('.frmcntr').html('<empty></empty>');

		$.ajax({
			type:'GET',
			url:'create-'+category,
			success:function(data){
				$('.frmcntr').html(data.frmcntr);
				$.each(data.cities, function(index, city) {
					$('#city.select-info').append('<option>' + city + '</option>');
				});
				if (category === 'automobile') {
					let model_select_field 				= $('#model');
					let custom_brand_container 			= $('#custom-brand');
					let custom_model_container 			= $('#custom-model');

					model_select_field.attr('disabled',true);
					custom_brand_container.detach();
					custom_model_container.detach();
					$('#brand').change(function() {
						model_select_field.attr('disabled',false);
						let brand = $('#brand').val();
						model_select_field.empty();
						model_select_field.prepend('<option selected disabled hidden value="">Izaberite</option>');

						if (brand !== 'Ostalo') {
							custom_brand_container.detach();
							custom_model_container.detach();

							$.ajax({
								headers: {
									'X-CSRF-TOKEN': $('input[name="_token"]').val()
									},
								type:'GET',
								url:'../vehicles/automobile/brand/models',
								data:{'brand':brand},
								success:function(data){
									$.each(data.models, function(index, model) {
										model_select_field.append('<option value ="'+model+'">' + model + '</option>');
									});
								}
							});
						}
						else if (brand ==='Ostalo') {
							model_select_field.attr('disabled',false);
							model_select_field.prepend('<option selected hidden value="Ostalo">Ostalo</option>')
							custom_brand_container.appendTo('#brand-container');
							custom_model_container.appendTo('#model-container');
							custom_model_container.show();
						}
					});
					$('#model').change(function() {
						let model = $('option:selected',this).html();

						if (model === 'Ostalo') {
							custom_model_container.appendTo('#model-container');
						}
						else {
							custom_model_container.detach();
						}
					});
				}

				if (category === 'motorcycle' || category === 'truck') {
					let custom_brand_container 	= $('#custom-brand');
					custom_brand_container.detach();
					$('#brand').change(function() {
						let brand = $('#brand').val();
						if (brand !== 'Ostalo') {
							custom_brand_container.detach();
						}
						else {
							custom_brand_container.appendTo('#brand-container');
						}
					});
				}

				if (category === 'parts') {
					$('#brand').attr('disabled',true);
					$('#brand').prepend('<option selected disabled hidden value="">Izaberite</option>');
					$('.vehicle_cat').change(function() {
						$('#brand').attr('disabled',false);
						var cat = $(this).val();
						$('#brand').empty();
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
				if (category !== 'parts' && category !== 'equipment') {
					$.each(data.brands, function(index, brand) {
						$('#brand.select-info').append('<option value ="'+brand+'">' + brand + '</option>');
					});
				}

				$('.frmcntr').trigger('frmcntrloaded');
				const zone = $('#show')[0];
				const sort = new Sortable(zone, {
					animation: 144,
					draggable: ".dz-preview",
					filter: "#add-img",
					preventOnFilter: true,
				});
				var drpzn = new Dropzone('#drpzn',{});
				let loader = `<div id="loader" class="loader-big"><i class="fas fa-cog"></i></div>`;
				$('#market-create-form').submit(function (e) {
					let fData = $(this).serializeArray();
					let url = $(this).attr('action');
					let photosCount = drpzn.files.length;
					let photosOrder = [];
					let photoEls = $('.drpz-container img');
					$.each(photoEls,function (key,val) {
						photosOrder.push($(val).attr('alt'));
					});
					if (photosCount === 0) {
						alert('Minimalno jedna fotografija obavezna');
						return e.preventDefault();
					}
					photosOrder = JSON.stringify(photosOrder);
					fData.push({name:'photosCount',value:photosCount},{name:'photosOrder',value:photosOrder});

					$.ajax({
						headers: {
							'X-CSRF-TOKEN': $('input[name="_token"]').val()
						},
						type: "POST",
						url: url,
						data: $.param(fData),
						beforeSend:function () {
							$('#submit-btn').attr('disabled',true);
							$('.frmcntr').css({opacity:0.5});
							$('.market-create-wrap').parent().prepend(loader);
						},
						success: function(data){
							window.location.replace(data.market_category+'/'+data.id+'/'+data.title);
						},
						error:function (data) {
							$('#submit-btn').attr('disabled',false);
							$('.frmcntr').css({opacity:1});
							$("#loader").remove();
							let once = true;
							$.each(data.responseJSON.errors,function (key,val) {
								(function () {
									if (once) {
										$('html,body').animate({
											scrollTop: $('#'+key).parent().offset().top - $('body').offset().top + $('body').scrollTop()
										});
									once = false;
									}
								})();
								$('#'+key).parent().find('.error-msg').show();
								$('#'+key).parent().find('.error-msg').html(val);
								$('#'+key).parent().find('.select-info').css({border:'1px solid red'});
								$('#'+key).parent().find('.input-info').css({border:'1px solid red'});
							});
						}
					});
					e.preventDefault();
				});
			}
		});
	});
});
