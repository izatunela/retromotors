@extends($ext)

@section('content')
	<div id="ajax-content">
		<p>Dashboard</p>
		<p>ovde kao neka statistika u vezi sajta</p>
	</div>
@endsection
@section('js')
{{-- <script src="{{asset('admin/js/dashboard.js')}}"></script> --}}
<script>
	$(function(){
		$.getScript('/admin/js/dashboard.js');
	});
</script>
@endsection