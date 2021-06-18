$(document).ready(function () {
	"use strict";
	function formatState(state) {
		if (!state.id) {
			return state.text;
		}
		var baseUrl = "/img/flags";
		var $state = $(
			`<img width="25" src="${baseUrl}/${$(state.element).html()}.png" class="img-flag" /><span class="select2-country-title">${state.text}</span>`
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
	$('.error-msg').hide();
	$('.select-info').on('change', function () {
		$(this).parent().find('.error-msg').hide();
		$(this).parent().find('.select-info').css({ border: '1px solid #aaa' });
	});
	$('.input-info').on('keyup', function () {
		if ($(this).val() === '') {
			$(this).parent().find('.error-msg').show();
			$(this).parent().find('.error-msg').html('Polje je obavezno');
			$(this).parent().find('.input-info').css({ border: '1px solid red' });
		}
		else {
			$(this).parent().find('.error-msg').hide();
			$(this).parent().find('.input-info').css({ border: '1px solid #aaa' });
		}
	});

	function cityfn() {
		cityWrap.show();
		let country = $('#country').val();
		if (country === '1') {
			citySelect.prop('disabled', false);
			citySelect2.show();
			cityInput2.remove();
		}
		else {
			cityWrap.append(cityInput2);
			citySelect.prop('disabled', true);
			citySelect2.hide();
		}
	}
	let cityWrap = $('.city');
	let cityHidden = $('.city-val').val();
	let cityInput2 = $(`<input id="city" class="input-data input-info form-control" placeholder="Grad" name="city" type="text" value="${cityHidden}">`);
	let citySelect = $('.select-info.city-custom');
	let citySelect2 = $('.select-info.city-custom').closest('.select2.select2-container');
	cityWrap.hide();
	cityfn();
	$('#country').change(function () {
		cityfn();
		cityInput2.val('');
	});

	let category = $('#ed-item-cat').attr('data-item-cat');
	if (category === 'Motorcycle' || category === 'Truck') {
		let custom_brand_container 	= $('#custom-brand');
		let brand 					= $('#brand').val();

		if (brand !== 'Ostalo') {
			custom_brand_container.detach();
		}

		$('#brand').change(function() {
			let brand = $('#brand').val();
			if (brand === 'Ostalo') {
				custom_brand_container.appendTo('#brand-container');
			}
			else{
				custom_brand_container.detach();
			}
		});
	}
	let negotiate_price = $('#negotiate_price');
	if ($(negotiate_price).is(':checked')) {
		$('#fixed_price').attr('disabled',true);
		$('#price').attr('readonly',true);
		$('#price').val(0);
	}
	$('#negotiate_price').on('change',function () {
		if ($('#fixed_price').attr('disabled')!=='disabled') {
			$('#fixed_price').attr('disabled',true);
			$('#price').attr('readonly',true);
			$('#price').val(0);
		}
		else{
			$('#fixed_price').attr('disabled',false);
			$('#price').attr('readonly',false);
			$('#price').val(null);
		}
	});
});
