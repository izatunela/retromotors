@extends('market/item/item')
@section('item-category')
<div class="wrap">
	<div class="row">
		@include('market/item/all/slider')
		@include('market/item/all/sideinfo')
		<div class="col-12">
			<div class="market-specification">
				<br>
				<h2 class="market-item-sec-title">Specifikacije</h2>
				<hr>
				<table class="table table-striped table-sm specification-table">
					<tbody>
						<tr>
							<th scope="row">Kilometraža</th>
							<td>{{number_format($Item->kilometerage,null,""," ")}} km / {{number_format($Item->kilometerage/1.609,null,""," ")}} mi </td>
							<th scope="row">Boja</th>
							<td>{{$Item->color->name}}</td>
						</tr>
						<tr>
							<th scope="row">Godina proizvodnje</th>
							<td>{{$Item->manufacture_year}}</td>
							<th scope="row">Menjač</th>
							<td>{{$Item->transmission->name}}</td>
						</tr>
						<tr>
							<th scope="row">Kubikaža</th>
							<td>{{number_format($Item->volume,null,""," ")}} cm<sup>3</sup></td>
							<th scope="row">Gorivo</th>
							<td>{{$Item->fuel->name}}</td>
						</tr>
						<tr>
							<th scope="row">Snaga</th>
							<td>{{number_format($Item->power,null,""," ")}} kW / {{number_format($Item->power*1.35962,null,""," ")}} hp</td>
							<th scope="row">Pogon</th>
							<td>{{$Item->drivetrain->name}}</td>
						</tr>
						<tr>
							<th scope="row">Stanje</th>
							<td>{{$Item->condition->name}}</td>
							<th scope="row">Tip</th>
							<td>{{$Item->type->name}}</td>
						</tr>
						<tr>
							<th scope="row">Registracija</th>
							<td>{{$Item->vehicleRegistration->name}}</td>
							<th scope="row">Lokacija</th>
							<td>{{$Item->city}} <span class="flag"><img title="{{$Item->country->name}}" height="" width="26" src="{{asset('img/flags/'.$Item->country->name.'.png')}}" alt=""></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-xs-12 col-sm-12">
			<div class="market-description">
				<br>
				<h2 class="market-item-sec-title">Dodatni opis</h2>
				<hr>
				<p>{{$Item->description}}</p>
				<hr>
			</div>
		</div>
	</div>
	@include('static/photoswipe-slider')
</div>
@endsection