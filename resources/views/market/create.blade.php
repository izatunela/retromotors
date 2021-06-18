@extends('master')
@section('css')
	<link rel="stylesheet" href="{{asset('css/plugin/dropzone.css')}}">
	<link rel="stylesheet" href="{{asset('css/pages/market/market-create.css')}}">
	<link rel="stylesheet" href="{{asset('css/plugin/dropzone-custom.css')}}">
@endsection
@section('content')
	<hr>
	<div class="market-create-wrap">
		
		<div class="row">
			<div class="col-12 col-sm-6 col-lg-3">
				<div class="form-group category-parent">
					{{Form::label('category', 'Izaberite kategoriju',['class' => ''])}}
					{{Form::select('category', ['automobile' => 'Automobili', 'motorcycle' => 'Motocikli','truck'=>'Teškaši','parts'=>'Delovi','equipment'=>'Oprema'], [], ['placeholder' => 'Izaberite','class' => 'category form-control'])}}
				</div>
			</div>
		</div>
		<div class="frmcntr">
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
		</div>
	</div>
@endsection
@section('js')
	<script src="{{asset('js/plugin/dropzone.js')}}"></script>
	<script src="{{asset('js/market/dropzone-conf.js')}}"></script>
	<script src="{{asset('js/market/form-market.js')}}"></script>
	<script src="{{asset('js/market/market-create.js')}}"></script>
	<script src="{{asset('js/plugin/sortable.js')}}"></script>
@endsection
