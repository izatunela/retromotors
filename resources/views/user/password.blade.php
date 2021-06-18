@extends('user/index')

@section('content')
	@include('static/alerts/alert-errors')
	@include('static/alerts/alert-success')
	<div class="profile-wrapper profile-settings">
		{{Form::open(['method'=>'post','url'=>route('user-password-change',Auth::user()->name),'id'=>'','class'=>''])}}
			{{-- <input type="hidden" name="_method" value="POST"> --}}
			<div class="row">
				<div class="col-12 col-sm-4">
					<div class="form-group">
						{{Form::label('old_password', 'Stara lozinka',['class' => ''])}}
						{{Form::password('old_password',['class'=>'input-data input-info form-control','placeholder'=>''])}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-4">
					<div class="form-group">
						{{Form::label('password', 'Nova lozinka',['class' => ''])}}
						{{Form::password('password',['class'=>'input-data input-info form-control','placeholder'=>''])}}
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-12 col-sm-4">
					<div class="form-group">
						{{Form::label('password_confirmation', 'Potvrdi novu lozinku',['class' => ''])}}
						{{Form::password('password_confirmation',['class'=>'input-data input-info form-control','placeholder'=>''])}}
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