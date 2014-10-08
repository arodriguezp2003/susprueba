@extends("layouts.master")

@section('contenido')
<div class="col-md-6 col-md-offset-3">
	<div class="panel panel-default">
	  <div class="panel-heading">
	    <h3 class="panel-title">Login de Usuario</h3>
	  </div>
	  <div class="panel-body">
	   <form class="form-horizontal" role="form" action="/login" method="POST" >
		  <div class="form-group">
		    <label for="inputEmail3" class="col-sm-2 control-label">Username</label>
		    <div class="col-sm-10">
		      <input  class="form-control" name="email" id="email" placeholder="username">

		    </div>
		  </div>
		  <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
		    <div class="col-sm-10">
		      <input type="password" class="form-control" name="password" id="password" placeholder="Password">
		    </div>
		  </div>

		  <div class="form-group">
		    <div class="col-sm-offset-2 col-sm-10">
		      <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-lock"></span> Login</button>
		      <a  class="btn btn-default" href="/fblogin">Login Facebook</a>
		    </div>
		  </div>
		</form>
	  </div>
	</div>
</div>
@stop