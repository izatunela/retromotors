{{Form::open(['url'=>route('market-store-automobile'),'files' => true,'id'=>'market-create-form','class'=>' ','novalidate'=>true])}}
{{-- <div class="container"> --}}
	{{-- <input id="marketID" type="hidden" name="marketID"> --}}
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group ">
				{{Form::label('country', 'Lokacija',['class' => ''])}} 
				{{Form::select('country',[1=>'Srbija','Slovenija','Hrvatska','Bosna i Hercegovina','Crna Gora','Makedonija'],[],['id'=>'country','required'=>true,'class'=>'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="city form-group">
				{{Form::label('city', 'Grad',['class' => 'city-label'])}}
				{{Form::select('city',[],null,['id'=>'city','class' => 'city-custom input-data select-info form-control'])}}
				{{-- {{Form::text('city',null,['id'=>'city','class'=>'input-data input-info form-control','placeholder'=>'Grad'])}} --}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div id="brand-container" class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('brand', 'Marka vozila',['class' => ''])}}
				{{Form::select('brand',[],[],['id'=>'brand','class'=>'input-data select-info vehicle-brand form-control'])}}
				<div class="error-msg"></div>
			</div>
			<div id="custom-brand" class="form-group">
				{{Form::label('custom_brand', 'Unesite marku vozila',['class' => ''])}}
				{{Form::text('custom_brand',null,['id'=>'','class'=>'input-data input-info form-control','placeholder'=>'Marka vozila'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div id="model-container" class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('model', 'Model vozila',['class' => ''])}}
				{{Form::select('model',[],[],['id'=>'model','class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
			<div id="custom-model" class="form-group">
				{{Form::label('custom_model', 'Unesite model vozila',['class' => ''])}}
				{{Form::text('custom_model','',['id'=>'','class'=>'input-data input-info form-control','placeholder'=>'Model vozila'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('type', 'Tip automobila',['class' => ''])}}
				{{Form::select('type', [1=>'Limuzina','Hatchback','Kupe','Karavan','Kabriolet','SUV','Pickup'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('manufacture_year', 'Godina proizvodnje',['class' => ''])}}
				{{Form::selectRange('manufacture_year', 2019, 1900,[],['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('drivetrain', 'Pogon vozila',['class' => ''])}}
				{{Form::select('drivetrain', [1 => 'Prednji','Zadnji','4x4'],[], ['class' => 'input-data select-info  form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('fuel', 'Pogonsko gorivo',['class' => ''])}}
				{{Form::select('fuel', [1 => 'Benzin','Dizel'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('color', 'Boja',['class' => ''])}}
				{{Form::select('color', [1=>'Bela','Be??','Bordo','Braon','Crna','Crvena','Narand??asta','Plava','Siva','Srebrna','Tirkiz','Teget','Zelena','Zlatna','??uta'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('transmission', 'Menja??',['class' => ''])}}
				{{Form::select('transmission', [1 => 'Automatski','Manuelni'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('vehicle_registration', 'Registracija vozila',['class' => ''])}}
				{{Form::select('vehicle_registration', [1 => 'Registrovan','Neregistrovan','Strane tablice','Odjavljen'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('condition', 'Stanje',['class' => ''])}}
				{{Form::select('condition', [1 => 'Originalno','Restaurirano','Novo','Polovno'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('kilometerage', 'Kilometra??a',['class' => ''])}}
				{{Form::number('kilometerage',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Broj predjenih kilometara','oninput'=>"validity.valid||(value='')"])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('volume', 'Kubika??a',['class' => ''])}}
				{{Form::number('volume',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Zapremina motora','oninput'=>"validity.valid||(value='')"])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('power', 'Snaga motora (kW)',['class' => ''])}}
				{{Form::number('power',null,['min'=>'1','class'=>'input-data input-info form-control','placeholder'=>'Broj kilovata','oninput'=>"validity.valid||(value='')"])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="price form-group">
				{{Form::label('price', 'Cena vozila (EUR)',['class' => ''])}}
				{{Form::number('price',null,['min'=>'1','id'=>'price','class'=>'input-data input-info form-control','placeholder'=>'Cena','oninput'=>"validity.valid||(value='')"])}}
				<div class="error-msg"></div>
			</div>
			<div class="checkbox-wrap">
				{{Form::checkbox('fixed_price', 1, null, ['id' => 'fixed_price'])}}
				{{Form::label('fixed_price', 'Fiksna cena',['class' => ''])}}
			</div>
			<div class="checkbox-wrap">
				{{Form::checkbox('negotiate_price', 1, null, ['id' => 'negotiate_price'])}}
				{{Form::label('negotiate_price', 'Dogovor',['class' => ''])}}
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12 col-lg-9">
			<div class="form-group">
				{{Form::label('description', 'Opis',['class' => ''])}}
				{{Form::textarea('description','',['id'=>'description','class'=>'input-data input-info form-control','placeholder'=>'Opis, Kontakt informacije...'])}}
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
	{{Form::button('Postavi', ['id'=>'submit-btn','class' => 'btn btn-primary','type'=>'submit','disabled'=>'disabled'])}}
{{Form::close()}}
