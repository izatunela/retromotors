@extends('emails/master-email')
@section('content')
	<p>Pozdrav {{$data->user->name}},</p>
	<p class="body-message">Da bi ste aktivirali vaš Retro Motors nalog potrebno je da potvrdite vaš email klikom na dugme ispod:</p>
	<div class="button">
		<a target="_blank" href="{{url('confirm/'.$data->confirmation_code)}}">POTVRDI</a>
	</div>
	<p style="margin-bottom: 30px">Hvala Vam na registraciji !</p>
	<p style="font-size: 12px;margin-bottom: 15px;">Ako ne možete da kliknete na dugme, kopirajte ovaj link u vaš internet pretraživač: <br><a target="_blank" href="{{url('confirm/'.$data->confirmation_code)}}">{{url('confirm/'.$data->confirmation_code)}}</a></p>
@endsection