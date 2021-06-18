@extends('market/item/item')
@section('item-category')
<div class="wrap">
	<div class="row">
		@include('market/item/all/slider')
		@include('market/item/all/sideinfo')
		<div class="col-xs-12 col-sm-12">
			<div class="market-specification">
				<br>
				<h2 class="market-item-sec-title">Specifikacije</h2>
				<hr>
				<table class="table table-striped table-sm specification-table">
					<tbody>
						<tr>
							<th scope="row">Stanje</th>
							<td>{{$Item->condition->name}}</td>
							<th></th>
							<td></td>
						</tr>
						<tr>
							<th scope="row">Lokacija</th>
							<td>{{$Item->city}} <span class="flag"><img title="{{$Item->country->name}}" height="" width="26" src="{{asset('img/flags/'.$Item->country->name.'.png')}}" alt=""></span></td>
							<th></th>
							<td></td>
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