<?php namespace Arp\Gen\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;
use \DB;
use \Schema;

class GenView extends Command { 

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gen:view';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Genera las Vistas (Index, new, update,delete)';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		//return $this->info("Se Genero las Vistas");
		
		$controller = $this->argument("view");
		$table = strtolower($controller."s");
		if($controller =="")
		{
			return $this->error("Falta agregar el Controlador");
		}

		if(!Schema::hasTable($table))
		{
			return $this->error("No existe la tabla ".$table." en la db: ");
		}


		 $campos = Schema::getColumnListing($table);

		 $fs = new Filesystem();
		 $path = app_path()."/views/".$controller."s/";
		 $name = $controller."s.blade.php";
		 $ths ="";
		 $td ="";
		foreach ($campos as $key => $value) {
			if($value!="updated_at"){
				if($value=="created_at")
					$ths=$ths."<th>Creado el:</th>\n\t\t\t\t";
				else
					$ths=$ths."<th>".ucfirst($value)."</th>\n\t\t\t\t";
				//relaciones
				if(strpos($value,'_id') !== false)
				{
					$rel = str_replace("_id","",$value);
					$td = $td." <td>{{\$r->".$rel."->nombre}} </td>\n\t\t\t\t";
				}
				else
				{
			 		$td = $td." <td>{{\$r->".$value."}}</td>\n\t\t\t\t";
				}
			}
		}

		 $index ="@extends('layout.master')

@section('content')

<h1>Listado de ".$controller."s</h1>

	<div class='input-group col-md-4 col-md-offset-8' > <span class='input-group-addon'>Buscar</span>
	    <input id='filter' type='text' class='form-control' placeholder='...'>
	</div>

<div class='table-responsive'>
    <table class='table table-striped'>
        <thead>
            <tr>
            	".$ths."
            	<th style='text-align: right'>Acciones</th>
            </tr>
        </thead>
        <tbody class='bbb'>
            @foreach(\$rows as \$r)
            <tr>
            	".$td."
            	 <td style='text-align: right'>
					{{ Form::open(array('action'=>array('".$controller."sController@deleteDestroy',\$r->id),'method'=>'DELETE','onsubmit'=>'return confirm(\"Estas Seguro?\")')) }}
                    <a href='".$table."/update/{{\$r->id}}'   class='btn btn-default btn-xs'>Editar</a>
                    {{Form::submit('Eliminar', ['class' => 'btn btn-warning btn-xs'])}}
                    {{ Form::close() }}
            	 <td/>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

{{ HTML::link('".$table."/new/', 'Nuevo',array('class' => 'btn btn-primary')) }}
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
@stop";
	

$create  ="
@extends('layout.master')
@section('content')
<div class='well bs-component col-md-6'>
{{ Form::open( array('role' => 'form' ) ) }}
	<fieldset>
	<legend>Nuevo ".$controller."</legend>
	@include('".$table."/_form')
	</fieldset>
{{ Form::close() }}
</div>
@stop";

$update  ="
@extends('layout.master')
@section('content')
<div class='well bs-component col-md-6'>
{{ Form::model(\$r, array('method' => 'PUT', 'role' => 'form' ) ) }}
	<fieldset>
	<legend>Nuevo ".$controller."</legend>
	@include('".$table."/_form')
	</fieldset>
{{ Form::close() }}
</div>
@stop";

$form ="";
foreach ($campos as $key => $value) {
	if($value !="id" && $value!="created_at" && $value!="updated_at")
	{
$form.="
	<div class='form-group'>
		<div class='col-md-12'>
			<label>".ucfirst($value)."</label>
			{{ Form::text('".$value."', null , array('class'=>'form-control')) }}
		</div>
	</div>";
	}

}
$form.="<div class='form-group'>
		<div class='col-md-4' style='margin-top:20px;'>
			<button class='form-control btn-success'>Guardar</button>
		</div>
	</div>
	<div class='form-group'>
		<div class='col-md-4' style='margin-top:20px;'>
			{{ HTML::link('".$table."/', 'Cancelar',array('class' => 'btn btn-default')) }}
		</div>
	</div>";



		if($fs->exists($path.$name))
		{
			return $this->error("El Archivo Existe: ".$path."index.blade.php");
		}
		
		$fs->deleteDirectory(strtolower($path));
		$fs->makeDirectory(strtolower($path));


		$fs->put(strtolower($path)."index.blade.php", $index);
		$fs->put(strtolower($path)."new.blade.php", $create);
		$fs->put(strtolower($path)."update.blade.php", $update);
		$fs->put(strtolower($path)."_form.blade.php", $form);
		return $this->info("Se Genero las Vistas"); 
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('view', InputArgument::REQUIRED, 'Nombre del Controlador en Singular.'),
		);
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return array(
			array('all', null, InputOption::VALUE_OPTIONAL, 'Todos true.', null),
			array('index', null, InputOption::VALUE_OPTIONAL, 'Todos true.', null),
			array('new', null, InputOption::VALUE_OPTIONAL, 'Todos true.', null),
			array('edit', null, InputOption::VALUE_OPTIONAL, 'Todos true.', null),
		);
	}

}
