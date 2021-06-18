@extends('user/index')

@section('content')
	@include('static/alerts/alert-errors')
	@include('static/alerts/alert-success')
	<div class="profile-wrapper profile-settings">
		{{Form::open(['method'=>'post','url'=>route('user-email-change',Auth::user()->name),'id'=>'','class'=>''])}}
			{{-- <input type="hidden" name="_method" value="POST"> --}}
			<div class="row">
				<div class="col-12">
					<div class="form-group">
						{{Form::label('email', 'Promeni Email',['class' => 'label-profile'])}}
						{{Form::email('email',$email,['id'=>'email','class'=>'input-data input-info form-control','placeholder'=>''])}}
					</div>
				</div>
			</div>
		{{Form::submit('Potvrdi', ['id'=>'submit-btn','class' => 'btn btn-primary'])}}
		{{Form::close()}}
	</div>
@endsection
@section('user-js')
<script>
	$(function(){
		$('.menu-item.settings').addClass('active');
		$('.profile-active-page').html('<i class="fas fa-wrench sidebar-icon"></i>Podešavanja');
	});
</script>
@endsection