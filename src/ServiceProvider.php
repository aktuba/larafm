<?php declare(strict_types=1);

namespace aktuba\Larafm;

use Illuminate\Support;

class ServiceProvider extends Support\ServiceProvider
{

	/**
	 * Perform post-registration booting of services.
	 */
	public function boot()
	{
		$this->publishes([
			__DIR__.'/../config/larafm.php' => config_path('larafm.php'),
		], 'config');
	}

	/**
	 * Register any package services.
	 */
	public function register()
	{
		$this->mergeConfigFrom(__DIR__.'/../config/larafm.php', 'larafm');

		$this->app->bind(Larafm::class, function () {
			return new Larafm(config('larafm.apiKey'), config('larafm.guzzle'));
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return [Larafm::class];
	}

}
