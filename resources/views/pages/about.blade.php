@extends('master')
@section('title','O nama')
@section('content')
<div class="about-page">
    <div class="about-bg">
        <div class="about-f"></div>
        <p class="about-paragraph">Sajt retromotors.rs je zamišljen kao platforma za povezivanje ljubitelja starih i klasičnih motornih vozila. Nismo ograničeni definicijom oldtajmera, i tu smo da objedinimo sve ono što bi se moglo podvesti pod pojam "retro" vozila, kao što i sam naziv sajta kaže.
        <br><br>
        Sajt je u velikoj meri i dalje u razvoju. Sugestije i kritike su dobrodošle i možete ih poslati na <span style="color:#fb0000">office@retromotors.rs</span>.
    </p>
    </div>
</div>
@endsection
@section('js')
<script>
    $('a.nav-link.about').addClass('active')
</script>
@endsection