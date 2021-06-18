{{Form::open(['url'=>route('market-store-parts'),'files' => true,'id'=>'market-create-form','class'=>'','novalidate'=>true])}}
	<div class="row">
		<div class="col-sm-12 col-lg-6">
			<div class="form-group">
				{{Form::label('title', 'Naslov',['class' => ''])}}
				{{Form::text('title','',['class'=>'input-data input-info form-control','placeholder'=>'Naslov'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
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
		<div class="col-sm-6 col-lg-3">
			<div class="form-group">
				{{Form::label('vehicle_category', 'Za vrstu vozila:',['class' => ''])}}
				{{Form::select('vehicle_category', [1 => 'Automobili','Motocikli','Teškaši'], [], ['class' => 'input-data select-info vehicle_cat form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-3">
			<div class="hide form-group">
				{{Form::label('brand', 'Za marku vozila',['class' => ''])}}
				{{Form::select('brand',[],null,['id'=>'brand','class'=>'input-data select-info brand form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3 ">
			<div class="form-group">
				{{Form::label('condition', 'Stanje',['class' => ''])}}
				{{Form::select('condition', [1 => 'Novo','Polovno'], [], ['class' => 'input-data select-info form-control'])}}
				<div class="error-msg"></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-6 col-lg-3">
			<div class="price form-group">
				{{Form::label('price', 'Cena predmeta (EUR)',['class' => ''])}}
				{{Form::number('price','',['min'=>'1','id'=>'price','class'=>'input-data input-info form-control','placeholder'=>'Cena','oninput'=>"validity.valid||(value='')"])}}
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
