<?php namespace Arp\Gen\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;
use Illuminate\Filesystem\Filesystem;;
use \DB;
use \Schema;
class GenController extends Command { 

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'gen:controller';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Genera Controlador';

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
		
		$controller = $this->argument("controller");
		$table = strtolower($controller."s");
		$campos = Schema::getColumnListing($table);



		if($controller =="")
		{
			return $this->error("Falta agregar el Controlador");
		}
	 $fs = new Filesystem();
	 $path = app_path()."/controllers/";
	 $name = $controller."sController.php";



	 $newSave = "\$r = new ".$controller.";\n";
	 $UpdateSave ="\$r = ".$controller."::find(\$id);";
	 foreach ($campos as $key => $value) {
	 	if($value !="id" && $value!="created_at" && $value!="updated_at")
	 	{
	 		$newSave .= "		\$r->".$value." =Input::get('".$value."');\n";

          $UpdateSave.="		\$r->".$value." =Input::get('".$value."');\n";
          
	 	}
	 }
	 $newSave .="
          \$r->save();
          return Redirect::to('".strtolower($controller)."s/')->with('tipo','1')->with('mensaje','Guardado Exitosamente!');";

	 $html ="<?php 
	 class ".$controller."sController extends BaseController {
     protected \$layout = 'layout/master';

     public function getIndex()
     {
          \$rows = ".$controller."::all();
          \$this->layout->content = View::make('".strtolower($controller)."s/index')
                                           ->with('rows', \$rows);
     }

     public function getShow(\$id)
     {
         \$count = ".$controller."::find(\$id)->count();    
          if(\$count==0) return Redirect::to('".strtolower($controller)."s/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
          \$rows = ".$controller."::find(\$id);
          \$this->layout->content = View::make('".strtolower($controller)."s/show')
                                           ->with('rows', \$rows);
     }
     
     public function getNew()
     {
         \$this->layout->content = View::make('".strtolower($controller)."s/new');
     }    
     
     public function postNew()
     {
		".$newSave."
          
     }  
	 public function getUpdate(\$id)
	 {
	 	  \$r = ".$controller."::find(\$id);
          \$this->layout->content = View::make('".strtolower($controller)."s/update')->with('r',\$r);
	 }

     public function putUpdate(\$id)
     {
          \$count = ".$controller."::find(\$id)->count();    
          if(\$count==0) return Redirect::to('".strtolower($controller)."s/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
		  ".$UpdateSave."
          \$r->save();
          return Redirect::to('".strtolower($controller)."s/')->with('tipo','1')->with('mensaje','Guardado Exitosamente!');
    
     }
     public function deleteDestroy(\$id)
     {
          \$count = ".$controller."::find(\$id)->count();    
          if(\$count==0) return Redirect::to('".strtolower($controller)."s/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
          \$r = ".$controller."::find(\$id);
          \$r->delete();

          return Redirect::to('".strtolower($controller)."s/')->with('tipo','1')->with('mensaje','Eliminado Exitosamente!');
     }

	}";



		if($fs->exists($path.$name))
		{
			return $this->error("El Archivo Existe: ".$path.$name);
		}
		$fs->put($path.$name, $html);
		return $this->info("Se Genero el Controlador: ".$path.$name);
		
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return array(
			array('controller', InputArgument::REQUIRED, 'Nombre del Controlador en Singular.'),
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
			//array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		);
	}

}
