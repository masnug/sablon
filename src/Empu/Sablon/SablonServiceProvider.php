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
		$this->registerListener();
		
		// include sablon helpers & demo routes
		include __DIR__.'/../../helpers.php';
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

        if ($theme == 'default') {
        	$theme = 'Aql2';
        	$theme_basepath = app_path('views/packages/empu/sablon');
        }
        else {
			$theme_basepath = $app['config']->get('sablon::themes_path');
        }

		$app['config']->set('sablon::theme', $theme);
		$app['config']->set('sablon::theme_basepath', $theme_basepath);
        // register theme namespace directory
        $app['view']->addNamespace('theme', "{$theme_basepath}/{$theme}");
	}

	protected function registerListener()
	{
		$app = $this->app;
		$app['events']->listen('composing: theme::layouts.base', function() use ($app) {
	        // set url to theme assets
	        $theme = $app['config']->get('sablon::theme');
	        $asset_basepath = str_replace(app_path('views/'), '', $app['config']->get('sablon::theme_basepath'));
	        $app['config']->set('sablon::theme_asset', "{$asset_basepath}/{$theme}");
		});
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