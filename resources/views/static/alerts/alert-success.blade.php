@if(session('status'))
	<div style="border-radius: 0" class="alert alert-success alert-wrap" role="alert">
	  {{session('status')}}
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	      <span aria-hidden="true">&times;</span>
	    </button>
	</div>
@endif