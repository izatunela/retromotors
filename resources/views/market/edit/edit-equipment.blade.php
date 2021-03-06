@extends('market/edit/edit')
	@section('content-css')
	@endsection
@section('content-category')
<hr>
<h1 class="edit-item-title">{{$item->title}}</h1>
<hr>
<div class="market-edit-wrap">
	{{ Form::model($item, ['route' => ['market-equipment-update','id'=> $item->id], 'method' => 'patch','files' => true,'id'=>'market-create-form','class'=>'edit-zone','novalidate'=>true]) }}
		<span style="visibility: none" id="ed-item-id" type="hidden" data-item-id="{{$item->id}}"></span>
		<span style="visibility: none" id="ed-item-cat" type="hidden" data-item-cat="{{$category}}"></span>
		@include('market/edit/all/dz-img-container')
		<div class="row">
			<div class="col-sm-12 col-lg-6">
				<div class="form-group">
					{{Form::label('title', 'Naslov',['class' => ''])}}
					{{Form::text('title',ucfirst(implode(' ',explode('-', $item->title))),['class'=>'input-data input-info form-control','placeholder'=>'Naslov'])}}
					<div class="error-msg"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('country', 'Lokacija',['class' => ''])}} 
					{{Form::select('country',[1=>'Srbija','Slovenija','Hrvatska','Bosna i Hercegovina','Crna Gora','Makedonija'],$item->country_id,['id'=>'country','required'=>true,'class'=>'input-data select-info form-control'])}}
					<div class="error-msg"></div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="city form-group">
					{{Form::label('city', 'Grad',['class' => 'city-label'])}}
					{{Form::select('city',$cities,$item->city,['id'=>'city','class' => 'city-custom input-data select-info form-control'])}}
					{{Form::hidden('city-val',$item->city,['class'=>'city-val'])}}
					<div class="error-msg"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3 ">
				<div class="form-group">
					{{Form::label('condition', 'Stanje',['class' => ''])}}
					{{Form::select('condition', [1 => 'Novo','Polovno'], $item->condition_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg"></div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="price form-group">
					{{Form::label('price', 'Cena predmeta (EUR)',['class' => ''])}}
					{{Form::number('price',null,['min'=>'1','id'=>'price','class'=>'input-data input-info form-control','placeholder'=>'Cena','oninput'=>"validity.valid||(value='')"])}}
					<div class="error-msg"></div>
				</div>
				<div class="checkbox-wrap">
					{{Form::label('fixed_price', 'Fiksna cena',['class' => ''])}}
					@if($item->fixed_price)
						{{Form::checkbox('fixed_price', 1,true,['id' => 'fixed_price']) }}
					@else
						{{Form::checkbox('fixed_price', 1,false,['id' => 'fixed_price']) }}
					@endif
				</div>
				<div class="checkbox-wrap">
					{{Form::label('negotiate_price', 'Dogovor',['class' => ''])}}
					@if($item->negotiate_price)
						{{Form::checkbox('negotiate_price', 1, true, ['id' => 'negotiate_price']) }}
					@else
						{{Form::checkbox('negotiate_price', 1, false, ['id' => 'negotiate_price']) }}
					@endif
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12 col-lg-9">
				<div class="form-group">
					{{Form::label('description', 'Opis',['class' => ''])}}
					{{Form::textarea('description',null,['id'=>'description','class'=>'input-data input-info form-control','placeholder'=>'Opis'])}}
					<div class="error-msg"></div>
				</div>
			</div>
		</div>
		@include('market/partials/market-contact')
		<div class="row">
			<div class="col-12 col-sm-12">
				<div id="drpzn" class="">
					<div id="show" class="input-info">
						<div id="add-img">
							<i class="fas fa-camera-retro"></i>
							<i class="fas fa-plus"></i>
							<small id="brojfotografija">Broj fotografija: <b></b></small>
						</div>
					</div>
					<div class="error-msg"></div>
				</div>
			</div>
		</div>
		{{Form::button('Sa??uvaj izmene', ['id'=>'submit-btn','class' => 'btn btn-primary','type'=>'submit'])}}
	{{Form::close()}}
</div>
@endsection
@section('content-js')
@endsection
