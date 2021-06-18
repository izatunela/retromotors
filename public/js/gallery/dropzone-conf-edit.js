$(function () {
	"use strict";
	let template = document.querySelector('#custom-template').innerHTML;
	Dropzone.options.drpzn = {
		paramName: "gallery_photos",
		url:'./temp/store-img',
		addRemoveLinks:false,
		uploadMultiple: true,
		parallelUploads: 1,
		maxFiles: 15,
		resizeWidth:1920,
		thumbnailWidth: null,
		thumbnailHeight:null,
		previewTemplate: template,
		previewsContainer:'#show',
		clickable: "#add-img",
		dictDefaultMessage: "",
		dictCancelUploadConfirmation: "Želite da otkažete upload?",
		acceptedFiles: ".jpeg,.jpg",
		error: function(file) {
			if (file.type !== "image/jpeg" && file.type !== "image/jpg") {
				alert('Dozvoljen format fotografija je JPG/JPEG');
				this.removeFile(file);
			}
		},
		init: function() {
			let theZone = this;
			let id = $('#ed-item-id').attr('data-item-id');
			let mockFile = [];
			theZone.deleteList = [];
			$.ajax({
				type:'post',
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
					},
				url:'./item/get-photos',
				data:{id:id},
				success:function(data){
					$.each(data.photos,function (index,photo) {
						mockFile.unshift({
							dataURL:'/storage/'+photo.path +'/tn-'+photo.filename, //videti u vezi ove rute, root domain
							name:photo.filename,
							mock:true,
							type:'image/jpeg'
						});
					});
					
					mockFile.forEach(function(mock){
						theZone.files.push(mock);
						theZone.emit('addedfile',mock);
						theZone.createThumbnailFromUrl(mock,
						theZone.options.thumbnailWidth, 
						theZone.options.thumbnailHeight,
						theZone.options.thumbnailMethod, true, function (thumbnail) 
							{
								theZone.emit('thumbnail', mock, thumbnail);
							});
						theZone.emit('complete', mock);
						$(mock.previewElement).insertAfter(addImageBtn);
					});
				}
			});
				
			let addImageBtn = $('#add-img');
			
			theZone.on('thumbnail',function () {
				$('.img-progress-wrap').show();
			});

			this.on('addedfile',function (file) {
				if (theZone.files.length) {
					for (let i = 0; i < theZone.files.length - 1; i++) {
						if(theZone.files[i].name === file.name && theZone.files[i].size === file.size && theZone.files[i].lastModifiedDate.toString() === file.lastModifiedDate.toString()){
							alert('Fotografija već postoji');
							this.removeFile(file);
						}
					}
				}

				$(file.previewElement).addClass('drpz-edit-img');
				$(file.previewElement).insertAfter(addImageBtn);

				if (theZone.files.length <= this.options.maxFiles) {
					$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
				}
				else if(theZone.files.length > this.options.maxFiles) {
					this.removeFile(file);
					$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
				}
			});

			this.on('maxfilesreached',function () {

			});
			this.on("sending", function(file, xhr, formData) {
				formData.append("_token",$('input[name="_token"]').val());
				formData.append("order",file.order);
				formData.append("fn",file.name);
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
			this.on('removedfile',function (file) {
				$('#brojfotografija b').html(theZone.options.maxFiles - theZone.files.length);
				if (file.mock) {
					theZone.deleteList.push(file.name);
				}
			});
			this.on('queuecomplete',function () {
				$('#submit-btn').attr('disabled',false);
			});
		}
	}
});