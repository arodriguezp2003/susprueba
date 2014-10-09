<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', function()
{
	return View::make('hello');
	//var_dump(Auth::check());
});
Route::get("/login",function()
{
	return View::make('login.index');
	
});
Route::get("/logout",function()
{
	Auth::logout();
	return View::make('login.index')->with("notice","Deslogeado Correctamente");
	
});

Route::post("/login",function()
{
	$data = [
		"email"=> Input::get("email"),
		"password"=> Input::get("password")
	];

	if(Auth::attempt($data)){
		return Redirect::action("subscription");
	}
	else{
			Session::flash('error', 'Tus datos son incorrectos');
			return View::make('login.index');
	}
	
});



Route::get('/fblogin', function() {
    $facebook = new Facebook(Config::get('facebook'));
    $params = array(
        'redirect_uri' => url('/login/fb/callback'),
        'scope' => 'email',
    );
    return Redirect::to($facebook->getLoginUrl($params));
});

Route::get('login/fb/callback', function() {
    $code = Input::get('code');
    if (strlen($code) == 0) return Redirect::to('/')->with('message', 'There was an error communicating with Facebook');

    $facebook = new Facebook(Config::get('facebook'));
    $uid = $facebook->getUser();

    if ($uid == 0) return Redirect::to('/')->with('message', 'There was an error');

    $me = $facebook->api('/me');

    $profile = Profile::whereUid($uid)->first();
    if (empty($profile)) {
 	
        $user = new User;
        $user->name = $me['first_name'].' '.$me['last_name'];
        $user->email = $me['email'];
        $user->avatar = 'https://graph.facebook.com/'.$me['id'].'/picture?type=large';

        $user->save();

        $profile = new Profile();
        $profile->uid = $uid;
        $profile->username = $me['id'];
        $profile = $user->profiles()->save($profile);
    }

    $profile->access_token = $facebook->getAccessToken();
    $profile->save();

    $user = $profile->user;
    Auth::login($user);

    return Redirect::action('subscription')->with('notice', 'Logeado con Facebook');
});











Route::group(['prefix'=>'admin','before'=>'not.admin'],function(){
	Route::get('/',[
		'as'=>'admin',
		'uses'=>'DashboardController@getIndex'
	]);
	Route::controller('plans','PlansController');
});




Route::group(['prefix'=>'subscription','before'=>'auth'],function(){

	Route::get('/',[
		'as'=>'subscription',
		'uses'=>'SubscriptionController@getIndex'
	]);

	Route::group(['before'=>'not.subscribed'],function(){

		Route::get('join',[
			'as'=>'subscription-join',
			'uses'=>'SubscriptionController@getJoin'
		]);

		Route::post('join',[
			'before'=>'csrf',
			'uses'=>'SubscriptionController@postJoin'
		]);

	});
	Route::group(['before'=>'subscribed'],function(){
		
		Route::get('cancel',[
			'before'=>'not.cancelled | csrf',
			'as'=>'subscription-cancel',
			'uses'=>'SubscriptionController@getCancel'
		]);

		Route::get('resume',[
			'before'=>'not.cancelled | csrf',
			'as'=>'subscription-resume',
			'uses'=>'SubscriptionController@getResume'
		]);
		Route::get('card',[
			'as'=>'subscription-card',
			'uses'=>'SubscriptionController@getCard'
		]);
		Route::post('card',[
			'before'=>'csrf',
			'uses'=>'SubscriptionController@postCard'
		]);
	});
});
Route::post('webhook/stripe', 'Laravel\Cashier\WebhookController@handleWebhook');
