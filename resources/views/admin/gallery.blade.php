@extends($ext)
@section('content')
	<div id="ajax-content">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Automobili</h5>
	
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content wew">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				
				<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter>
					<thead>
					<tr>
						<th data-toggle="true">Naziv</th>
						<th>Autor</th>
						<th data-hide="phone,tablet" data-type="">Postavljen</th>
						<th data-hide="phone,tablet">Opis</th>
						<th data-hide="all">Izbrisan</th>
						<th data-hide="phone,tablet">Action</th>
					</tr>
					</thead>
					<tbody id="parent-users">
					@foreach($gallery as $item)
					<tr>
						<td>{{$item->title}}</td>
						<td>{{$item->user()->withTrashed()->first()->name}}</td>
						<td>{{$item->created_at->format('d.M.Y H:i:s')}}</td>
						<td>{{$item->description}}</td>
						@if(isset($item->deleted_at))
						<td>{{$item->deleted_at->format('d.M.Y H:i:s')}}</td>
						@else
						<td>--/--</td>
						@endif
						<td>
							<button class="btn custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button>
							<button class="btn custom-button gallery-delete" type="button"  data-gallery-id="{{$item->id}}"><i class="icon-red fas fa-times"></i> Delete</button>
						</td>
					</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="4">
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
				<input type="text" class="form-control input-sm m-b-xs" id="filter-del" placeholder="Search in table">
				
				<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter-del>
					<thead>
					<tr>
						<th data-toggle="true">Naziv</th>
						<th>Autor</th>
						<th data-hide="phone,tablet" data-type="">Postavljen</th>
						<th data-hide="phone,tablet">Opis</th>
						<th data-hide="all">Izbrisan</th>
						<th data-hide="phone,tablet">Action</th>
					</tr>
					</thead>
					<tbody id="parent-users" class="table-del">
					@foreach($inactive_gallery as $item)
					<tr class="izbrisani">
						<td>{{$item->title}}</td>
						<td>{{$item->user()->withTrashed()->first()->name}}</td>
						<td>{{$item->created_at->format('d.M.Y H:i:s')}}</td>
						<td>{{$item->description}}</td>
						<td>{{$item->deleted_at->format('d.M.Y H:i:s')}}</td>
						<td>
							{{-- <button class="btn custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button> --}}
							<button class="btn custom-button gallery-restore" type="button"  data-gallery-id="{{$item->id}}">
								<i class="icon-red fas fa-times"></i> Restore</button>
						</td>
					</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="4">
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
		$('#admin-gallery').addClass('active');
		$.getScript('/admin/js/gallery.js');
	});
</script>
@endsection