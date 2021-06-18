@extends('emails/master-email')
@section('content')
    <p class="body-message">Da bi ste potvrdili novi email kliknite na dugme ispod:</p>
    <div class="button">
        <a target="_blank" href="{{url('user/email/confirm/'.$data->confirmation_code)}}">POTVRDI</a>
    </div>
    <p style="font-size: 12px;margin-bottom: 15px;">Ako ne možete da kliknete na dugme, kopirajte ovaj link u vaš internet pretraživač: <br><a target="_blank" href="{{url('user/email/confirm/'.$data->confirmation_code)}}">{{url('user/email/confirm/'.$data->confirmation_code)}}</a></p>
@endsection