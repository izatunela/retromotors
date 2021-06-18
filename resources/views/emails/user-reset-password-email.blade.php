@extends('emails/master-email')
@section('content')
	<p style="margin: 20px 0">Pozdrav {{$data->user->name}},</p>
	<p style="">Dobili smo zahtev za promenu vaše Retro Motors lozinke. Da izaberete novu lozinku, kliknite na dugme ispod: </p>
	<div class="button">
		<a target="_blank" href="{{url('password/reset/'.$data->token)}}">PROMENA LOZINKE</a>
	</div>
	<p style="margin-bottom: 30px">Ako niste podneli zahtev za promenu lozinke dovoljno je da ignorišete ovaj mejl.</p>
	<p style="font-size: 12px">Ako ne možete da kliknete na dugme, kopirajte ovaj link u vaš internet pretraživač: <br><a target="_blank" href="{{url('password/reset/'.$data->token)}}">{{url('password/reset/'.$data->token)}}</a></p>
@endsection