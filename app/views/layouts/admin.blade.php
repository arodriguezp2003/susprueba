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
    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Administracion</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="/admin/plans/">Planes</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="{{Auth::user()->avatar}}" height="22px" alt="...">
                {{Auth::user()->name}} <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#">Suscripcion</a></li>
                <li><a href="#">Notas</a></li>
                <li><a href="#">Tareas</a></li>
                <li class="divider"></li>
                <li><a href="/logout">Logout</a></li>
         
              </ul>
            </li>
              
             
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