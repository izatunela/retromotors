$(document).ready(function () {
	'use strict';

	let drpzn = new Dropzone('#drpzn');
	let loader = `<div id="loader" class="loader-big"><i class="fas fa-cog"></i></div>`;
	$('#market-create-form').submit(function (e) {
		let deleteList = drpzn.deleteList;
		let id = $('#ed-item-id').attr('data-item-id');
		let fData = $(this).serializeArray();
		let photoEls = $('.drpz-edit-img');
		let imgFile = $('.drpz-edit-img img');
		let photosCount = drpzn.files.length || photoEls.length; //popraviti length kada se ne doda slika nego se samo reorderuje ili menja forma
		let orderedPhotos = [];
		
		$.each(imgFile,function (key,val) {
			orderedPhotos.push($(val).attr('alt'));
		});
	
		fData.push(
			{name:'photosCount',value:photosCount},
			{name:'id',value:id},
			// {name:'category',value:category},
			{name:'orderedPhotos',value:JSON.stringify(orderedPhotos)},
			{name:'deleteList',value:JSON.stringify(deleteList)},
			);
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('input[name="_token"]').val()
			},
			type: "POST",
			url: 'update',
			data: $.param(fData),
			beforeSend:function () {
				$('#submit-btn').attr('disabled',true);
				$('.market-edit-wrap').css({opacity:0.5});
				$('.market-edit-wrap').parent().prepend(loader);
			},
			success: function(data){
				window.location.replace('/market/'+data.market_category+'/'+data.id+'/'+data.title);
			},
			error: function (data) {
				$('#submit-btn').attr('disabled', false);
				$('.market-edit-wrap').css({ opacity: 1 });
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
});