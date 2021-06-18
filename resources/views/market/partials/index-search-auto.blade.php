<div id="search-container">
	{{Form::open(['url'=>route('search-market-automobile'),'method'=>'get','id'=>'market-search-form','class'=>' ','novalidate'=>true])}}
		<div class="row">
			<div id="brand-container" class="col-sm-6 col-lg-4 ">
				<div class="form-group">
					{{Form::select('brand',$brands->toArray(),$keywords['brand']??null,['placeholder' => 'Svi proizvodjači','id'=>'brand','class'=>'input-data select-info vehicle-brand form-control'])}}
				</div>
			</div>
			<div id="model-container" class="col-sm-6 col-lg-4 ">
				<div class="form-group">
					@if(isset($models) && isset($keywords['model']))
					{{Form::select('model',['Svi modeli'=>'Svi modeli']+$models->toArray()+['Ostalo'=>'Ostalo'],$keywords['model'],['id'=>'model','class' => 'input-data select-info form-control'])}}
					@else
					{{Form::select('model',['Svi modeli'=>'Svi modeli'],[],['id'=>'model','class' => 'input-data select-info form-control'])}}
					@endif
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="manufacture_year-search-wrap form-group">
					{{Form::select('min_manufacture_year',['Godište od']+array_combine(range(1900,2019),range(1900,2019)),$keywords['min_manufacture_year']??null,['id'=>'min-year','class' => 'input-data select-info form-control'])}} -
					{{Form::select('max_manufacture_year',['Godište do']+array_combine(range(2019,1900),range(2019,1900)),$keywords['max_manufacture_year']??null,['id'=>'max-year','class' => 'input-data select-info form-control'])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 ">
				<div class="form-group">
					{{Form::select('fuel',['Gorivo']+[1 => 'Benzin','Dizel'], $keywords['fuel']??null, ['id'=>'fuel','class' => 'input-data select-info form-control'])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="search-price-wrap form-group">
					{{Form::number('min_price',$keywords['min_price']??null,['min'=>0,'class' => 'search-price input-data form-control','placeholder'=>'min EUR','oninput'=>"validity.valid||(value='')"])}} -
					{{Form::number('max_price',$keywords['max_price']??null,['min'=>0,'class' => 'search-price input-data form-control','placeholder'=>'max EUR','oninput'=>"validity.valid||(value='')"])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 ">
				<div class="form-group ">
					{{Form::select('country',['Sve države']+[1=>'Srbija','Slovenija','Hrvatska','Bosna i Hercegovina','Crna Gora','Makedonija'],$keywords['country']??null,['id'=>'country','required'=>true,'class'=>'input-data select-info form-control'])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 offset-sm-6 offset-lg-8">
				{{Form::button('Pretraga', ['id'=>'uni-search-btn','class' => 'btn btn-primary','type'=>'submit'])}}
			</div>
		</div>
	{{Form::close()}}
</div>
