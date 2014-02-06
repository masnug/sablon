<?php
namespace Empu\Sablon;

use Illuminate\Support\ServiceProvider;

class SablonServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('empu/sablon', 'sablon');
		
		// register theme view namespace
		$this->themeNamespace();
		
		// include sablon demo routes
		include __DIR__.'/../../routes.php';
	}

	/**
	 * Providing `theme` view namespace
	 * @return void
	 */
	protected function themeNamespace()
	{
		$app = $this->app;
		// get default theme from config
        $theme = $app['config']->get('sablon::theme', 'default');
        // register theme namespace directory
        if ($theme == 'default') {
	        $app['view']->addNamespace('theme', app_path('views/packages/empu/sablon/Aql2'));
        }
        else {
			$theme_path = $app['config']->get('sablon::themes_path');
	        $app['view']->addNamespace('theme', "{$theme_path}/{$theme}");
        }
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		// register TwigBridge
		$this->app->register('TwigBridge\TwigServiceProvider');
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		// return array();
	}

}