
@extends('layout.master')
@section('content')
<div class='well bs-component col-md-6'>
{{ Form::open( array('role' => 'form' ) ) }}
	<fieldset>
	<legend>Nuevo Plan</legend>
	@include('plans/_form')
	</fieldset>
{{ Form::close() }}
</div>
@stop