<?php
class SubscriptionController extends BaseController {

	protected $user;
	public function __construct(){
		$this->user = Auth::user();
	}
	public function getIndex()
	{
		return View::make('subscription.index')->with('user',$this->user);
	}

	public function getJoin(){

		return View::make('subscription.join');

	}
	public function postJoin(){
		$this->user->subscription(Input::get("plan"))->create(Input::get("token"),[
			'email'=>$this->user->email
		]);
		return Redirect::action("subscription")->with("notice","subscripcion Completa :)");
		
	}
	public function getCancel()
	{
		$this->user->subscription()->cancel();
		return Redirect::action("subscription")->with("notice","Subscripcion Cancelada :(");;
	}

	public function getResume()
	{
		$this->user->subscription($this->user->stripe_plan)->resume();
		return Redirect::action("subscription")->with("notice","Gracias por Volver :)");;
	}

	public function getCard(){
		return View::make('subscription.card');
	}
	public function  postCard(){
		$this->user->updateCard(Input::get("token"));
		return Redirect::action("subscription")->with("notice","Tarjeta Actualizada");;

	}
}