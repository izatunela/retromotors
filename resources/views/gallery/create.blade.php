@extends('master')
@section('css')
	<link rel="stylesheet" href="{{asset('css/plugin/dropzone.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugin/dropzone-custom.css')}}">
	<link rel="stylesheet" href="{{asset('css/pages/gallery/gallery-create.css')}}">
@endsection
@section('content')
	<hr>
	<div class="create-gallery-wrap">
		<div id="custom-template" class="">
			<div class="drpz-container dz-preview">
				<img data-dz-thumbnail>
				<div class="img-progress-wrap">
					<div class="img-progress"></div>
					<div class="progress-percent"><span class="percent-value">0%</span></div>
				</div>
				<a class="rmv-img" href="#" data-dz-remove><i class="fas fa-times"></i></a>
			</div>
		</div>
		{{Form::open(['url'=>route('gallery-store'),'files' => true,'id'=>'gallery-create-form','class'=>'','novalidate'=>true])}}
			<div class="form-group">
				{{Form::label('title', 'Naslov',['class' => ''])}}
				{{Form::text('title','',['id'=>'title','class'=>'input-info form-control','placeholder'=>'Naslov'])}}
				<div class="error-msg"></div>
			</div>
			<div class="form-group">
				{{Form::label('description', 'Opis',['class' => ''])}}
				{{Form::textarea('description','',['id'=>'description','class'=>'input-info form-control','placeholder'=>'Opis'])}}
				<div class="error-msg"></div>
			</div>
			<div class="row">
				<div class="col-sm-12">
					<div id="drpzn" class="">
						<div id="show" class="input-info">
							<div id="add-img">
								<i class="fas fa-camera-retro"></i>
								<i class="fas fa-plus"></i>
								<small id="brojfotografija">Broj fotografija: <b></b></small>
							</div>
							<div class="error-msg"></div>
						</div>
					</div>
				</div>
			</div>
			{{Form::button('Postavi', ['id'=>'submit-btn','class' => 'btn btn-primary','type'=>'submit','disabled'=>'disabled'])}}
		{{Form::close()}}
	</div>
@endsection
@section('js')
	<script src="{{asset('js/plugin/dropzone.js')}}"></script>
	<script src="{{asset('js/gallery/create-gallery.js')}}"></script>
	<script src="{{asset('js/plugin/sortable.js')}}"></script>
	<script src="{{asset('js/plugin/sort-cfg.js')}}"></script>
@endsection