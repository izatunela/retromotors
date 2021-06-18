$(function () {
	"use strict";
	let template = document.querySelector('#custom-template').innerHTML;
	Dropzone.options.drpzn = {
		paramName: "market_photos",
		url:"store-market-temp-img",
		addRemoveLinks:false,
		uploadMultiple: true,
		parallelUploads: 1,
		maxFiles: 15,
		resizeWidth:1920,
		thumbnailWidth: 108,
		thumbnailHeight:108,
		previewTemplate: template,
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
			let theZone = this;
			let category = $('.category').val();
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
				let addImageBtn = $('#add-img');
				let previews = $('.dz-preview');
					previews.insertAfter(addImageBtn);

				if (theZone.files.length <= theZone.options.maxFiles) {
					$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
				}
				else if(theZone.files.length > theZone.options.maxFiles) {
					theZone.removeFile(file);
					$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
				}
			});
			theZone.on("sending", function(file, xhr, formData) {
				formData.append("_token",$('input[name="_token"]').val());
				formData.append("category",category);
			});

			this.on('removedfile',function (f) {
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
});