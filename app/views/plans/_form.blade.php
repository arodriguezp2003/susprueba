
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Codigo</label>
			{{ Form::text('codigo', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Nombre</label>
			{{ Form::text('nombre', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Descripcion</label>
			{{ Form::text('descripcion', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Monto</label>
			{{ Form::text('monto', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Moneda</label>
			{{ Form::text('moneda', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Tiempo</label>
			{{ Form::text('tiempo', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Trial</label>
			{{ Form::text('trial', null , array('class'=>'form-control')) }}
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-12'>
			<label>Desc</label>
			{{ Form::text('desc', null , array('class'=>'form-control')) }}
		</div>
	</div><div class='form-group'>
		<div class='col-md-4' style='margin-top:20px;'>
			<button class='form-control btn-success'>Guardar</button>
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-4' style='margin-top:20px;'>
			{{ HTML::link('plans/', 'Cancelar',array('class' => 'btn btn-default')) }}
		</div>
	</div>