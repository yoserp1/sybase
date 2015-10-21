<?php namespace Yoserp1\SybaseEloquent\Src;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\QueueEntityResolver;
use Yoserp1\SybaseEloquent\Src\SybaseConnection;
use Illuminate\Support\ServiceProvider;

class SybaseServiceProvider extends ServiceProvider
{

	/**
	* Bootstrap the application services.
	*
	* @return void
	*/
	public function boot()
	{
		Model::setConnectionResolver($this->app['db']);

		Model::setEventDispatcher($this->app['events']);
	}

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        // Register the MySql connection class as a singleton
        // because we only want to have one, and only one,
        // MySql database connection at the same time.
        $this->app->singleton('db.connection.miPaquete', function ($app, $parameters) {
            // First, we list the passes parameters into single
            // variables. I do this because it is far easier
            // to read than using it as eg $parameters[0].
            list($connection, $database, $prefix, $config) = $parameters;

            // Next we can initialize the connection.
            return new SybaseConnection($connection, $database, $prefix, $config);
        });
    }
}
