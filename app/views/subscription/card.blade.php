@extends("layouts.master")

@section('contenido')
	<form id="subscription-form" role="form" action="{{ URL::action('subscription-card') }}" method="POST">

		@include('subscription._card')

		<button class="btn btn-success">Update Payment</button>
		{{Form::token()}}
	</form>

@stop

@section('script')
	<script src="https://js.stripe.com/v2"></script>
	<script src="{{ asset('js/stripe.js')}}"></script>

@stop

