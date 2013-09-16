<?php namespace Leinbach\Generators;

use Illuminate\Support\ServiceProvider;

class GeneratorsServiceProvider extends ServiceProvider {

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
		$this->registerModelGeneratorCommand();
		$this->commands('generate.model');
		
	}

	protected function registerModelGeneratorCommand() {
		$this->app['generate.model'] = $this->app->share(function($app)
		{
			$generator = new Generators\ModelGenerator($app['files']);
			
			return new Commands\ModelGeneratorCommand($generator);
		});
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