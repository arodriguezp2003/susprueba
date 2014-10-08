@extends("layouts.master")

@section('contenido')
	<form id="subscription-form" role="form" action="{{ URL::action('subscription-join') }}" method="POST">
		<div class="form-group">
			<label for="">Select Plan</label>
			<select class="form-control" name="plan" id="plan">
				<option  value="Personal">Personal $5.00 USD/month</option>
				<option  value="small">Small $14.99 USD/month</option>
				<option  value="pro1">Professional 10 $29.00 USD/month</option>
			</select>
		</div>
		@include('subscription._card')

		<button class="btn btn-success">Make Payment</button>
		{{Form::token()}}
	</form>

@stop

@section('script')
	<script src="https://js.stripe.com/v2"></script>
	<script src="{{ asset('js/stripe.js')}}"></script>

@stop

