
@extends('layout.master')
@section('content')
<div class='well bs-component col-md-6'>
{{ Form::model($r, array('method' => 'PUT', 'role' => 'form' ) ) }}
	<fieldset>
	<legend>Nuevo Plan</legend>
	@include('plans/_form')
	</fieldset>
{{ Form::close() }}
</div>
@stop