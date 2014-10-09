<?php namespace Arp\Gen\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;;
use \DB;
use \Schema;
class GenModel extends Command { 

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gen:model';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Genera Modelo';

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
		//
		$controller = $this->argument("model");
		$HasMany = $this->option("hasMany");
		$belongsTo = $this->option("belongsTo");
		$relacion ="";
		if(strlen($HasMany) >  0)
		{
			$relacion = "public function ".$HasMany ."()
	{
	  return \$this->hasMany('".ucfirst ($HasMany)."');
	}";
		}

		if(strlen($belongsTo) >  0)
		{
			$relacion = "public function ".$belongsTo ."()
	{
	  return \$this->belongsTo('".ucfirst ($belongsTo)."');
	}";
		}




		if($controller =="")
		{
			return $this->error("Falta agregar el Controlador");
		}
	 $fs = new Filesystem();
	 $path = app_path()."/models/";
	 $name = $controller.".php";

	 $html ="<?php

class ".$controller." extends Eloquent  {
	".$relacion."
}
";



		if($fs->exists($path.$name))
		{
			return $this->error("El Archivo Existe: ".$path.$name);
		}
		$fs->put($path.$name, $html);
		return $this->info("Se Genero el Modelo en: ".$path.$name);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('model', InputArgument::REQUIRED, 'Nombre del Controlador en Singular.')
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
			array('hasMany', null, InputOption::VALUE_OPTIONAL, 'HasMany to Plural', null),
			array('belongsTo', null, InputOption::VALUE_OPTIONAL, 'belongTo to Singular',null )
		);
	}

}
