@extends($ext)
@section('content')
	<div id="ajax-content">
		<div class="row">
		<div class="col-12">
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Retro Motors korisnici</h5>
	
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					{{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-wrench"></i>
					</a> --}}
					{{-- <ul class="dropdown-menu dropdown-user">
						<li><a href="#">Config option 1</a>
						</li>
						<li><a href="#">Config option 2</a>
						</li>
					</ul> --}}
				</div>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter" placeholder="Search in table">
				
				<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter>
					<thead>
					<tr>
						<th data-toggle="true">Ime</th>
						<th data-hide="">Rank</th>
						<th data-hide="phone,tablet">Email</th>
						<th data-hide="all">Status</th>
						<th data-hide="all">Telefon</th>
						<th data-hide="all">Grad</th>
						<th data-hide="all">Država</th>
						<th data-hide="all">Registrovan</th>
						<th data-hide="all">Izbrisan</th>
						<th data-hide="phone,tablet" data-type="numeric" {{-- data-hide="all" --}}>Ukupno oglasa</th>
						<th data-hide="phone,tablet" data-type="numeric" {{-- data-hide="all" --}}>Predmeta u galeriji</th>
						<th data-hide="phone,tablet">Action</th>
					</tr>
					</thead>
					<tbody id="parent-users">
					@foreach($users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->role->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->status}}</td>
						<td>{{$user->phone}}</td>
						<td>{{$user->city}}</td>
						<td>{{$user->country}}</td>
						<td>{{$user->created_at->format('d.M.Y H:i:s')}}</td>
						@if(isset($user->deleted_at))
							<td>{{$user->deleted_at->format('d.M.Y H:i:s')}}</td>
						@else
							<td>Aktivan</td>
						@endif
						<td><a href="">{{$user->numOfMarketItems()}}</a></td>
						<td><a href="">{{$user->galleryItems()->count()}}</a></td>
						@if(!$user->isAdmin())
							<td>
								<button class="btn  custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button>
								<button class="btn  custom-button user-delete" type="button" data-user-id={{$user->id}}><i class="icon-red fas fa-times"></i> Delete</button>
							</td>
						@endif
					</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="7">
							<ul class="pagination center"></ul>
						</td>
					</tr>
					</tfoot>
				</table>
	
			</div>
		</div>
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Deaktivirani korisnici</h5>
	
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
					{{-- <a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="fa fa-wrench"></i>
					</a> --}}
					{{-- <ul class="dropdown-menu dropdown-user">
						<li><a href="#">Config option 1</a>
						</li>
						<li><a href="#">Config option 2</a>
						</li>
					</ul> --}}
				</div>
			</div>
			<div class="ibox-content">
				<input type="text" class="form-control input-sm m-b-xs" id="filter-inactive-users" placeholder="Search in table">
				
				<table class="footable table table-stripped toggle-arrow-tiny" data-filter=#filter-inactive-users>
					<thead>
					<tr>
						<th data-toggle="true">Ime</th>
						<th>Rank</th>
						<th data-hide="phone,tablet">Email</th>
						<th data-hide="all">Status</th>
						<th data-hide="all">Telefon</th>
						<th data-hide="all">Grad</th>
						<th data-hide="all">Država</th>
						<th data-hide="all">Registrovan</th>
						<th data-hide="all">Izbrisan</th>
						<th data-hide="phone,tablet" data-type="numeric" {{-- data-hide="all" --}}>Ukupno oglasa</th>
						<th data-hide="phone,tablet" data-type="numeric" {{-- data-hide="all" --}}>Predmeta u galeriji</th>
						<th data-hide="phone,tablet">Action</th>
					</tr>
					</thead>
					<tbody id="parent-users">
					@foreach($inactive_users as $user)
					<tr>
						<td>{{$user->name}}</td>
						<td>{{$user->role->name}}</td>
						<td>{{$user->email}}</td>
						<td>{{$user->status}}</td>
						<td>{{$user->phone}}</td>
						<td>{{$user->city}}</td>
						<td>{{$user->country}}</td>
						<td>{{$user->created_at->format('d.M.Y H:i:s')}}</td>
						@if(isset($user->deleted_at))
							<td>{{$user->deleted_at->format('d.M.Y H:i:s')}}</td>
						@else
							<td>Aktivan</td>
						@endif
						<td><a href="">{{$user->numOfMarketItems()}}</a></td>
						<td><a href="">{{$user->numOfGalleryItems()}}</a></td>
						@if(!$user->isAdmin())
							<td>
								<button class="btn  custom-button" type="button"><i class="icon-blue fas fa-edit"></i> Edit</button>
								<button class="btn  custom-button user-restore" type="button" data-user-id={{$user->id}}><i class="icon-red fas fa-times"></i> Restore</button>
							</td>
						@endif
					</tr>
					@endforeach
					</tbody>
					<tfoot>
					<tr>
						<td colspan="6">
							<ul class="pagination center"></ul>
						</td>
					</tr>
					</tfoot>
				</table>
	
			</div>
		</div>
		<div class="ibox float-e-margins">
			<div class="ibox-title">
				<h5>Novi korisnik</h5>
				<div class="ibox-tools">
					<a class="collapse-link">
						<i class="fa fa-chevron-up"></i>
					</a>
				</div>
			</div>
			<div class="ibox-content create-user-wrap">
				<form id="user-create-form" class="form-horizontal" action="{{url('/users/create')}}" method="post">
					{{csrf_field()}}

					<div class="form-group">
						<label class="col-lg-2 control-label">Username</label>
						<div class="col-lg-4">
						<input type="text" name="name" placeholder="Username" class="form-control"> <span class="help-block m-b-none"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-lg-2 control-label">Email</label>
						<div class="col-lg-4">
						<input type="email" name="email" placeholder="Email" class="form-control"> <span class="help-block m-b-none"></span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-lg-2 control-label">Lozinka</label>
						<div class="col-lg-4">
							<input type="text" name="password" placeholder="Lozinka" class="form-control">
							<input type="text" name="password_confirmation" placeholder="Potvrdi lozinku" class="form-control">
						</div>
					</div>

					{{-- <div class="form-group">
						<label class="col-lg-2 control-label">Rank</label>
						<div class="col-lg-4">
							<select name="role" id="">
								<option value="1">Administrator</option>
								<option value="2">Moderator</option>
								<option value="3">User</option>
							</select>
						</div>
					</div> --}}
					
					<div class="form-group">
						<div class="col-lg-offset-2 col-lg-4">
							<button class="btn btn-sm btn-white" type="submit">Napravi</button>
						</div>
					</div>
				</form>
				{{-- @include('static/alerts/alert-errors') --}}

			</div>
		</div>
	</div>
</div>
</div>
@endsection
@section('js')
{{-- <script class="content-js" src="{{asset('admin/js/plugins/footable/footable.all.min.js')}}"></script> --}}
{{-- <script class="content-js" src="{{asset('admin/js/users.js')}}"></script> --}}
<script>
	// $.getScript('admin/js/plugins/footable/footable.all.min.js');
	$.getScript('/admin/js/users.js');
</script>
@endsection