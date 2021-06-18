$(function () {
	$.ajax({
		method: 'GET',
		url: '/vehicles/all/brands',
		success: function (data) {
			$('.vehicle_cat').change(function () {
				$('#brand').empty();
				$('#brand').attr('disabled', false);
				var cat = $(this).val();
				if (cat === '1') {
					$.each(data.auto, function (index, brand) {
						$('#brand.select-info').append('<option value ="' + index + '">' + brand + '</option>');
					});
				}
				else if (cat === '2') {
					$.each(data.moto, function (index, brand) {
						$('#brand.select-info').append('<option value ="' + index + '">' + brand + '</option>');
					});
				}
				else if (cat === '3') {
					$.each(data.truck, function (index, brand) {
						$('#brand.select-info').append('<option value ="' + index + '">' + brand + '</option>');
					});
				}
			});
		}
	});
});
