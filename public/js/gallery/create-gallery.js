$(function () {
	"use strict";
	
	Dropzone.options.drpzn = {
		paramName: "gallery_photos",
		url:"store-gallery-temp-img",
		addRemoveLinks:false,
		uploadMultiple: true,
		parallelUploads: 1,
		maxFiles: 15,
		thumbnailWidth:108,
		thumbnailHeight:108,
		resizeWidth:1920,
		previewTemplate:$('#custom-template').html(),
		previewsContainer:'#show',
		clickable: "#add-img",
		dictDefaultMessage: "",
		dictCancelUploadConfirmation: "Želite da otkažete upload?",
		acceptedFiles: ".jpeg,.jpg",
		error: function(file, message,xhr) {
			if (file.type !== "image/jpeg" && file.type !== "image/jpg") {
				alert('Dozvoljen format fotografija je JPG/JPEG');
				this.removeFile(file);
			}
		},
		init: function() {
			var theZone = this;

			$('#custom-template').remove();
			$('#brojfotografija b').html(this.options.maxFiles);

			theZone.on('thumbnail',function () {
				$('.img-progress-wrap').show();
			});

			theZone.on('addedfile',function (file) {
				if (theZone.files.length) {
					for (let i = 0; i < theZone.files.length - 1; i++) {
						if(theZone.files[i].name === file.name && theZone.files[i].size === file.size && theZone.files[i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
							alert('Fotografija već postoji');
							this.removeFile(file);
						}
					}
				}

				var addImageBtn = $('#add-img');
				var previews = $('.drpz-container');
					previews.insertAfter(addImageBtn);

				if (theZone.files.length <= theZone.options.maxFiles) {
					var currentFiles = theZone.files.length;
					$('#brojfotografija b').html(theZone.options.maxFiles - currentFiles);
				}
				else if(theZone.files.length > theZone.options.maxFiles) {
					theZone.removeFile(file);
				}
			});
			theZone.on("sending", function(file, xhr, formData) {
			  formData.append("_token",$('input[name="_token"]').val());
			});

			theZone.on('removedfile',function (f) {
				$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
			});

			this.on('processing',function () {
				$('#submit-btn').attr('disabled',true);
			});

			this.on('uploadprogress',function (f,progress) {
				let p = Math.round(progress);
				let img_el = $(f.previewElement).find('.img-progress');
				let p_el = $(f.previewElement).find('.percent-value');
				img_el.css({
					width:(100 - p) +'%'
				});
				p_el.html(p+'%');
			});
			this.on('complete',function (f) {
				let img_el = $(f.previewElement).find('.img-progress');
				let p_el = $(f.previewElement).find('.percent-value');

				img_el.fadeOut();
				p_el.fadeOut();
			});

			this.on('queuecomplete',function () {
				$('#submit-btn').attr('disabled',false);
			});
		}
	}
	
	var drpzn = new Dropzone('#drpzn',{});
	let loader = `<div id="loader" class="loader-big"><i class="fas fa-cog"></i></div>`;
	$('#gallery-create-form').submit(function (e) {
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
				$('#submit-btn').attr('disabled', true);
				$('.create-gallery-wrap').css({ opacity: 0.5 });
				$('.create-gallery-wrap').parent().prepend(loader);
			},
			success: function(data){
				window.location.replace(data.id+'/'+data.title);
			},
			error: function (data) {
				$('#submit-btn').attr('disabled', false);
				$('.create-gallery-wrap').css({ opacity: 1 });
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
		return false;
	});

	$('.input-info').on('keyup',function () {
		if($(this).val() === '') {
			$(this).parent().find('.error-msg').show();
			$(this).parent().find('.input-info').css({border:'1px solid red'});
		}
		else{
			$(this).parent().find('.error-msg').hide();
			$(this).parent().find('.input-info').css({border:'1px solid #aaa'});
		}
	});
});