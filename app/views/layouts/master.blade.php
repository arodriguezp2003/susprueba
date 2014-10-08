<!DOCTYPE html>
<html lang="es">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Subscription</title>
	<link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootr.css') }}">
	<link rel="stylesheet" href="{{ asset('css/boot.css') }}">
</head>
<body>
	    <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">POS</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="#">Inicio</a></li>
            <li><a href="#about">Planes</a></li>
            <li><a href="#contact">Contacto</a></li>
            @if(!Auth::check())
            	<li><a href="/login">Login</a></li>
            @else
				<li><a href="/logout">Logout</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>
	<div class="container">
		@include('layouts._mensajes')
		@yield('contenido')
	</div>
	 
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/holder.js') }}"></script>
	 @yield('script')
</body>
</html>