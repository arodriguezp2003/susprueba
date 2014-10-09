@extends('layouts.master')

@section('contenido')

<h1>Listado de Plans</h1>

	<div class='input-group col-md-4 col-md-offset-8' > <span class='input-group-addon'>Buscar</span>
	    <input id='filter' type='text' class='form-control' placeholder='...'>
	</div>

<div class='table-responsive'>
    <table class='table table-striped'>
        <thead>
            <tr>
            	<th>Id</th>
				<th>Codigo</th>
				<th>Nombre</th>
				<th>Descripcion</th>
				<th>Monto</th>
				<th>Moneda</th>
				<th>Tiempo</th>
				<th>Trial</th>
				<th>Desc</th>
				<th>Creado el:</th>
				
            	<th style='text-align: right'>Acciones</th>
            </tr>
        </thead>
        <tbody class='bbb'>
            @foreach($rows as $r)
            <tr>
            	 <td>{{$r->id}}</td>
				 <td>{{$r->codigo}}</td>
				 <td>{{$r->nombre}}</td>
				 <td>{{$r->descripcion}}</td>
				 <td>{{$r->monto}}</td>
				 <td>{{$r->moneda}}</td>
				 <td>{{$r->tiempo}}</td>
				 <td>{{$r->trial}}</td>
				 <td>{{$r->desc}}</td>
				 <td>{{$r->created_at}}</td>
				
            	 <td style='text-align: right'>
					{{ Form::open(array('action'=>array('PlansController@deleteDestroy',$r->id),'method'=>'DELETE','onsubmit'=>'return confirm("Estas Seguro?")')) }}
                    <a href='plans/update/{{$r->id}}'   class='btn btn-default btn-xs'>Editar</a>
                    {{Form::submit('Eliminar', ['class' => 'btn btn-warning btn-xs'])}}
                    {{ Form::close() }}
            	 <td/>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ HTML::link('plans/new/', 'Nuevo',array('class' => 'btn btn-primary')) }}
<script src='https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js'></script>
<script>

$(document).ready(function () {
	
    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.bbb tr').hide();
            $('.bbb tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});

</script>
@stop