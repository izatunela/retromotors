$(document).on('frmcntrloaded',function () {
	(function (globals) {
	"use strict";
	// globals.trigger = false;
		function formatState(state) {
			if (!state.id) {
				return state.text;
			}
			var baseUrl = "/img/flags";
			var $state = $(
				`<img width="28" src="${baseUrl}/${$(state.element).html()}.png" class="img-flag" /><span class="select2-country-title">${state.text}</span>`
			);
			return $state;
		}
		function formatStateMarketCategorySelected(state) {
			if (!state.id) {
				return state.text;
			}
			var baseUrl = "/img/flags";
			var $state = $(
				`<img width="28" src="${baseUrl}/${state.element.text}.png" class="img-flag" /><span class="market-category-form">${state.text}</span>`
			);
			return $state;
		}
		$('select').on('select2:open', function () {
			$('.select2-search input').prop('focus', 0);
		});
		$('.select-info').select2({
			containerCssClass: ':all:',
		});
		$('#country').select2({
			containerCssClass: ':all:',
			templateResult: formatState,
			templateSelection: formatStateMarketCategorySelected,
		});

		$('.select-info').prepend('<option selected disabled hidden value="">Izaberite</option>');
		let select = $('select.select-info');

		$('.error-msg').hide();
		$('.select-info').on('change',function () {
			$(this).parent().find('.error-msg').hide();
			$(this).parent().find('.select-info').css({border:'1px solid #aaa'});
		});
		$('.input-info').on('keyup',function () {
			if($(this).val() === '') {
				$(this).parent().find('.error-msg').show();
				$(this).parent().find('.error-msg').html('Polje je obavezno');
				$(this).parent().find('.input-info').css({border:'1px solid red'});
			}
			else{
				$(this).parent().find('.error-msg').hide();
				$(this).parent().find('.input-info').css({border:'1px solid #aaa'});
			}
		});

		let cityWrap = $('.city');
		let cityInput2 = $(`<input id="city" class="input-data input-info form-control" placeholder="Grad" type="text" name="city">`);
		let citySelect = $('.select-info.city-custom');
		let citySelect2 = $('.select-info.city-custom').closest('.select2.select2-container');
		cityWrap.hide();
		$('#country').change(function() {
			cityWrap.show();
			let country = $(this).val();
			if (country === '1') {
				citySelect.prop('disabled', false);
				citySelect2.show();
				cityInput2.remove();
			}
			else{
				$('.city-label').after(cityInput2);
				citySelect.prop('disabled', true);
				citySelect2.hide();
			}
		});

		$('#negotiate_price').on('change',function () {
			if ($('#fixed_price').attr('disabled')!=='disabled') {
				$('#fixed_price').attr('disabled',true);
				$('#price').attr('disabled',true);
			}
			else{
				$('#fixed_price').attr('disabled',false);
				$('#price').attr('disabled',false);
			}
		});
	}( (1,eval)('this') ));
});
