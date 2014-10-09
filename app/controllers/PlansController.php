<?php 
class PlansController extends BaseController {

    

     public function getIndex()
     {
          $rows = Plan::all();
          return View::make('plans/index')->with('rows', $rows);
     }
/*
     public function getShow($id)
     {
         $count = Plan::find($id)->count();    
          if($count==0) return Redirect::to('plans/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
          $rows = Plan::find($id);
          $this->layout->content = View::make('plans/show')
                                           ->with('rows', $rows);
     }
     
     public function getNew()
     {
         $this->layout->content = View::make('plans/new');
     }    
     
     public function postNew()
     {
		$r = new Plan;
		$r->codigo =Input::get('codigo');
		$r->nombre =Input::get('nombre');
		$r->descripcion =Input::get('descripcion');
		$r->monto =Input::get('monto');
		$r->moneda =Input::get('moneda');
		$r->tiempo =Input::get('tiempo');
		$r->trial =Input::get('trial');
		$r->desc =Input::get('desc');

          $r->save();
          return Redirect::to('plans/')->with('tipo','1')->with('mensaje','Guardado Exitosamente!');
          
     }  
	 public function getUpdate($id)
	 {
	 	  $r = Plan::find($id);
          $this->layout->content = View::make('plans/update')->with('r',$r);
	 }

     public function putUpdate($id)
     {
          $count = Plan::find($id)->count();    
          if($count==0) return Redirect::to('plans/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
		  $r = Plan::find($id);		$r->codigo =Input::get('codigo');
		$r->nombre =Input::get('nombre');
		$r->descripcion =Input::get('descripcion');
		$r->monto =Input::get('monto');
		$r->moneda =Input::get('moneda');
		$r->tiempo =Input::get('tiempo');
		$r->trial =Input::get('trial');
		$r->desc =Input::get('desc');

          $r->save();
          return Redirect::to('plans/')->with('tipo','1')->with('mensaje','Guardado Exitosamente!');
    
     }
     public function deleteDestroy($id)
     {
          $count = Plan::find($id)->count();    
          if($count==0) return Redirect::to('plans/')->with('tipo','0')->with('mensaje','No se encuentra el registro seleccionado');
         
          $r = Plan::find($id);
          $r->delete();

          return Redirect::to('plans/')->with('tipo','1')->with('mensaje','Eliminado Exitosamente!');
     }
*/
}