@extends("layouts.master")

@section('contenido')

	<h1>Perfil del Usuario</h1>
	<hr>
	<div class="row">
		  <div class="col-md-2">
		    <a href="#" class="thumbnail">
		      @if($user->avatar!="")
		      	<img src="{{$user->avatar}}" alt="...">
		      @else
		      	<img src="{{asset('img/nophoto.png')}}" alt="...">
		      @endif
		    </a>
		  </div>
		  <div class="col-md-10">
		  		<h2>{{$user->name}}</h2>
		  		<p>Email   : {{$user->email}}</p>
		  		<p>Facebook: {{$user->facebook}}</p>
		  		<p>Twitter : {{$user->twitter}}</p>
		  		<p><a href="">Editar Perfil</a></p>
		  </div>
 	 </div>


	<h3>Suscripción</h3>
	@if($user->subscribed())
		<p>Tu Plan es {{$user->stripe_plan}}</p>
		@if($user->cancelled())
			<p>Su Suscripción termina el {{ $user->subscription_ends_at->format('D d M Y') }}</p>
		@endif
		<ul>
			@if(!$user->cancelled())
			<li><a href="{{ URL::action('subscription-cancel') }}?_token={{ csrf_token() }}">Cancelar Subscripcion</a></li>
			@else
			<li><a href="{{URL::action('subscription-resume') }}?_token={{ csrf_token()}}">Seguir con la subscripcion</a></li>
			@endif
			@if($user->subscribed())
				<li><a href="{{URL::action('subscription-card') }}">Actualizar Tarjeta</a></li>
			@endif
		</ul>
	@else
		<p>Usted Es un Usuario Free!!! <a href="{{ URL::action('subscription-join') }}">Unete Ahora y se Premium!</a></p>
	@endif
@stop

@section("script")

@stop