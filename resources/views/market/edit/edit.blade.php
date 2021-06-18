@extends('master')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/dropzone.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/plugin/dropzone-custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/pages/market/market-create.css')}}">
    @yield('content-css')
@endsection
@section('content')
    @yield('content-category')
@endsection
@section('js')
	<script src="{{asset('js/plugin/dropzone.js')}}"></script>
	<script src="{{asset('js/market/dropzone-conf-edit.js')}}"></script>
	<script src="{{asset('js/market/edit-market.js')}}"></script>
	<script src="{{asset('js/market/update-market.js')}}"></script>
	<script src="{{asset('js/plugin/sortable.js')}}"></script>
    <script src="{{asset('js/plugin/sort-cfg.js')}}"></script>
    @yield('content-js')
@endsection