@extends('market/edit/edit')
	@section('content-css')
	@endsection
@section('content-category')
<hr>
<h1 class="edit-item-title">{{$item->title}}</h1>
<hr>
<div class="market-edit-wrap">
	{{ Form::model($item, ['route' => ['market-truck-update','id'=> $item->id], 'method' => 'patch','files' => true,'id'=>'market-create-form','class'=>'edit-zone','novalidate'=>true]) }}
		<span style="visibility: none" id="ed-item-id" type="hidden" data-item-id="{{$item->id}}"></span>
		<span style="visibility: none" id="ed-item-cat" type="hidden" data-item-cat="{{$category}}"></span>
		@include('market/edit/all/dz-img-container')
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group ">
					{{Form::label('country', 'Lokacija',['class' => ''])}} 
					{{Form::select('country',[1=>'Srbija','Slovenija','Hrvatska','Bosna i Hercegovina','Crna Gora','Makedonija'],$item->country_id,['id'=>'country','required'=>true,'class'=>'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite drzavu</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="city form-group">
					{{Form::label('city', 'Grad',['class' => 'city-label'])}}
					{{Form::select('city',$cities,$item->city,['id'=>'city','class' => 'city-custom input-data select-info form-control'])}}
					<div class="error-msg">Polje je obavezno</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div id="brand-container" class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('brand', 'Marka vozila',['class' => ''])}}
					{{Form::select('brand',$brands,$item->brand->name,['id'=>'brand','class'=>'input-data select-info vehicle-brand form-control'])}}
					<div class="error-msg">Molimo izaberite marku vozila</div>
				</div>
				<div id="custom-brand" class="form-group">
					{{Form::label('custom_brand', 'Marka vozila',['class' => ''])}}
					{{Form::text('custom_brand',$item->customBrandModel->brand??null,['id'=>'','class'=>'input-data input-info form-control','placeholder'=>'Marka vozila'])}}
					<div class="error-msg"></div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('model', 'Model vozila',['class' => ''])}}
					{{Form::text('model',$item->model,['id'=>'model','class'=>'input-data input-info form-control','placeholder'=>'Model'])}}
					<div class="error-msg">Molimo unesite model</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="form-group">
					{{Form::label('type', 'Tip',['class' => ''])}}
					{{Form::select('type', [1=>'Kamion', 'Kombi', 'Autobus', 'Kamper'], $item->type_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg"></div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('manufacture_year', 'Godina proizvodnje',['class' => ''])}}
					{{Form::selectRange('manufacture_year', 1900, 2017,null,['class' => 'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite godinu</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('axle', 'Broj osovina',['class' => ''])}}
					{{Form::select('axle', [1=>2,3,4,5,6], null, ['class'=>'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite broj osovina</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('fuel', 'Pogonsko gorivo',['class' => ''])}}
					{{Form::select('fuel', [1 => 'Benzin','Dizel'], $item->fuel_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite pogonsko gorivo</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('color', 'Boja',['class' => ''])}}
					{{Form::select('color', [1=>'Bela','Bež','Bordo','Braon','Crna','Crvena','Narandzasta','Plava','Siva','Srebrna','Tirkiz','Teget','Zelena','Zlatna','Žuta','Ostalo'], $item->color_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite boju</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('transmission', 'Menjač',['class' => ''])}}
					{{Form::select('transmission', [1 => 'Automatski','Manuelni'], $item->transmission_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg">Molimo izaberite menjac</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('vehicle_registration', 'Registracija vozila',['class' => ''])}}
					{{Form::select('vehicle_registration', [1 => 'Registrovan','Neregistrovan','Strane tablice','Odjavljen'], $item->vehicle_registration_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg"></div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('condition', 'Stanje',['class' => ''])}}
					{{Form::select('condition', [1 => 'Originalno','Restaurirano','Novo','Polovno'], $item->condition_id, ['class' => 'input-data select-info form-control'])}}
					<div class="error-msg"></div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('kilometerage', 'Kilometraža',['class' => ''])}}
					{{Form::number('kilometerage',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Broj predjenih kilometara','oninput'=>"validity.valid||(value='')"])}}
					<div class="error-msg">Molimo unesite kilometrazu</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('volume', 'Kubikaža',['class' => ''])}}
					{{Form::number('volume',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Zapremina motora','oninput'=>"validity.valid||(value='')"])}}
					<div class="error-msg">Molimo unesite kubikazu</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('power', 'Snaga motora (kW)',['class' => ''])}}
					{{Form::number('power',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Broj kilovata','oninput'=>"validity.valid||(value='')"])}}
					<div class="error-msg">Molimo unesite snagu motora</div>
				</div>
			</div>
			<div class="col-sm-6 col-lg-3">
				<div class="form-group">
					{{Form::label('capacity', 'Nosivost (kg)',['class' => ''])}}
					{{Form::number('capacity',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Nosivost','oninput'=>"validity.valid||(value='')"])}}
					<div class="error-msg">Molimo unesite nosivost</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-3">
				<div class="price form-group">
					{{Form::label('price', 'Cena vozila (EUR)',['class' => ''])}}
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
		{{Form::button('Sačuvaj izmene', ['id'=>'submit-btn','class' => 'btn btn-primary','type'=>'submit'])}}
	{{Form::close()}}
</div>
@endsection
@section('content-js')
@endsection