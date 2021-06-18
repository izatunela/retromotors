@extends('master')
@section('title','Upload')
@section('content')

	
<h1>Create post</h1>

	{{Form::open(['files' => true])}}
<div class="form-group">

	{{Form::label('title', 'Title',['class' => ''])}}
	{{Form::text('title','',['class'=>'form-control','placeholder'=>'Title'])}}
</div>

<div class="form-group">

	{{Form::label('body', 'Description',['class' => ''])}}
	{{Form::textarea('body','',['class'=>'form-control','placeholder'=>'Description'])}}
</div>

<div class="form-group">
	
	{{Form::label('user_photo', 'User Photo',['class' => ''])}}
	{{Form::file('user_photo')}}
</div>

	{{Form::submit('Save', ['class' => 'btn btn-primary'])}}

	{{Form::close()}}
	
@endsection