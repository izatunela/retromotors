@extends($ext)
@section('content')
<div id="ajax-content">
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Oprema</h5>
	
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<input type="text" class="form-control input-sm m-b-xs" id="filter-del" placeholder="Search in table">
				
			<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter-del>
				<thead>
				<tr>
					<th data-toggle="true">Naziv</th>
					<th data-type="numeric">Cena</th>
					<th>Prodavac</th>
					<th data-hide="phone,tablet">Grad</th>
					<th data-hide="phone,tablet">Država</th>
					<th data-hide="phone,tablet">Postavljen</th>
					<th data-hide="all">Opis</th>
					<th data-hide="all">Izbrisan</th>
					<th data-hide="phone,tablet">Action</th>
				</tr>
				</thead>
				<tbody id="parent-users">
				@foreach($data['items'] as $item)
				<tr>
					<td>{{$item->title}}</td>
					<td>{{$item->price}}</td>
					<td>{{$item->user->name}}</td>
					<td>{{$item->city}}</td>
					<td>{{$item->country->name}}</td>
					<td>{{$item->created_at->format('d.M.Y H:i:s')}}</td>
					<td>{{$item->description}}</td>
					@if(isset($item->deleted_at))
					<td>{{$item->deleted_at->format('d.F.Y H:i:s')}}</td>
					@else
					<td>--/--</td>
					@endif
					<td>
						<button class="btn custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button>
						<button class="btn custom-button model-delete" type="button" data-category="equipment" data-model-id="{{$item->id}}"><i class="icon-red fas fa-times"></i> Delete</button>
					</td>
				</tr>
				@endforeach
				</tbody>
				<tfoot>
				<tr>
					<td colspan="9">
						<ul class="pagination center"></ul>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
	<div class="ibox float-e-margins">
		<div class="ibox-title">
			<h5>Izbrisani oglasi</h5>
	
			<div class="ibox-tools">
				<a class="collapse-link">
					<i class="fa fa-chevron-up"></i>
				</a>
			</div>
		</div>
		<div class="ibox-content">
			<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				
			<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter>
				<thead>
				<tr>
					<th data-toggle="true">Naziv</th>
					<th data-type="numeric">Cena</th>
					<th>Prodavac</th>
					<th data-hide="phone,tablet">Grad</th>
					<th data-hide="phone,tablet">Država</th>
					<th data-hide="phone,tablet">Postavljen</th>
					<th data-hide="all">Opis</th>
					<th data-hide="all">Izbrisan</th>
					<th data-hide="phone,tablet">Action</th>
				</tr>
				</thead>
				<tbody id="parent-users">
				@foreach($data['del_items'] as $item)
				<tr>
					<td>{{$item->title}}</td>
					<td>{{$item->price}}</td>
					<td>{{$item->user()->withTrashed()->first()->name}}</td>
					{{-- <td>{{$item->user->name}}</td> --}}
					<td>{{$item->city}}</td>
					<td>{{$item->country->name}}</td>
					<td>{{$item->created_at->format('d.M.Y H:i:s')}}</td>
					<td>{{$item->description}}</td>
					@if(isset($item->deleted_at))
					<td>{{$item->deleted_at->format('d.F.Y H:i:s')}}</td>
					@else
					<td>--/--</td>
					@endif
					<td>
						{{-- <button class="btn custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button> --}}
						@if(!$item->user()->withTrashed()->first()->deleted_at)
							<button class="btn custom-button model-restore" type="button" data-category="equipment" data-model-id="{{$item->id}}">
							<i class="icon-red fas fa-times"></i> Restore</button>
						@else
						<span>korisnik je izbrisan</span>
						@endif
					</td>
				</tr>
				@endforeach
				</tbody>
				<tfoot>
				<tr>
					<td colspan="9">
						<ul class="pagination center"></ul>
					</td>
				</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>
@endsection
@section('js')
<script>
	$(function () {
		$('#admin-market').addClass('active');
		$('#admin-market ul').addClass('in');
		$('.market-equip').addClass('active');
		$.getScript('/admin/js/market.js');
	});
</script>
@endsection