<div id="search-container">
	{{Form::open(['url'=>route('search-market-equipment'),'method'=>'get','id'=>'market-search-form','class'=>' ','novalidate'=>true])}}
		<div class="row">
			<div class="col">
				<div class="form-group">
					{{Form::text('keyword',$keywords['keyword']??null,['id'=>'keyword','class' => 'input-data form-control','placeholder'=>'Unesite ključne termine ( kaciga, rukavice, ... )'])}}
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-lg-4 ">
				<div class="form-group">
					{{Form::select('country',['Sve države']+[1=>'Srbija','Slovenija','Hrvatska','Bosna i Hercegovina','Crna Gora','Makedonija'],$keywords['country']??null,['id'=>'country','class'=>'input-data select-info form-control'])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 ">
				<div class="form-group ">
					{{Form::select('condition',['Novo + Polovno']+[1=>'Novo','Polovno'],$keywords['condition']??null,['class'=>'input-data select-info form-control'])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4">
				<div class="search-price-wrap form-group">
					{{Form::number('min_price',$keywords['min_price']??null,['min'=>0,'class' => 'search-price input-data form-control','placeholder'=>'min EUR','oninput'=>"validity.valid||(value='')"])}} - 
					{{Form::number('max_price',$keywords['max_price']??null,['min'=>0,'class' => 'search-price input-data form-control','placeholder'=>'max EUR','oninput'=>"validity.valid||(value='')"])}}
				</div>
			</div>
			<div class="col-sm-6 col-lg-4 offset-lg-8">
				{{Form::button('Pretraga', ['id'=>'uni-search-btn','class' => 'btn btn-primary','type'=>'submit'])}}
			</div>
		</div>
	{{Form::close()}}
</div>