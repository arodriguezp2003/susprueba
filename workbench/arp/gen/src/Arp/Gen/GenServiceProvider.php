<?php namespace Arp\Gen;

use Illuminate\Support\ServiceProvider;

class GenServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
		$this->app["gen.controller"] = $this->app->share(function(){
			return new Commands\GenController();
		});
		
		$this->app["gen.model"] = $this->app->share(function(){
			return new Commands\GenModel();
		});
		$this->app["gen.view"] = $this->app->share(function(){
			return new Commands\GenView();
		});
		$this->commands(
			'gen.model',
			'gen.controller',
			'gen.view'

			);
			


	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}
