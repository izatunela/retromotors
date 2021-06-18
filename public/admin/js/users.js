$(function () {
	$('.footable').footable();
	$('#admin-users').addClass('active');
	$('#user-create-form').submit(function (e) {
		e.preventDefault();
		let fData = $(this).serializeArray();
		let url = $(this).attr('action');
		$.ajax({
			headers: {
				'X-CSRF-TOKEN': $('input[name="_token"]').val()
			},
			type: "POST",
			url: url,
			data: $.param(fData),
			dataType:'json',
			success: function(data){
				console.log(data);
			},
			error:function (data) {
				// console.log(data.responseJSON.errors);
				console.log(data);
				let _err_list = `<div class="alert alert-danger"> <ul class="err-list"></ul> </div>`
					$('.create-user-wrap').append(_err_list);
				$.each(data.responseJSON.errors,(index,error)=>{
					let _err = `<li>${error}</li>`
					$('.err-list').append(_err);
				})
			}
		});
	});
	$('.user-delete').on('click',function(){
		if (!confirm('Potvrdi')) return;
		let id = this.dataset.userId;
		// console.log(id);
		// return;
		$.ajax({
			url:'/users/delete/'+id,
			success:function(){
				$.ajax({
					type: 'GET',
					url: window.location.href,
					// dataType: 'json',
					success: function (data) {
						$('.content-section').html(data.html);

					},
				});
			}
		});
	});
	
	$('.user-restore').on('click',function(){
		if (!confirm('Potvrdi')) return;
		let id = this.dataset.userId;
		// console.log(id);
		// return;
		$.ajax({
			url:'/users/restore',
			data:{'id':id},
			success:function(){
				$.ajax({
					type: 'GET',
					url: window.location.href,
					// dataType: 'json',
					success: function (data) {
						$('.content-section').html(data.html);

					},
				});
			}
		});
	});

});