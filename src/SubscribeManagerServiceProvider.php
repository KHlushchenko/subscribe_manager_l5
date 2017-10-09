<?php namespace Vis\SubscribeManager;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;

class SubscribeManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        require __DIR__ . '/../vendor/autoload.php';

        $this->setupRoutes($this->app->router);

        $this->loadViewsFrom(realpath(__DIR__ . '/resources/views'), 'subscribe_manager');

        if (file_exists(config_path('builder/tb-definitions/'))) {
            $this->publishes([
                __DIR__ . '/published/tb-definitions/' => config_path('builder/tb-definitions/')
            ], 'subscribe_manager_nodes');
        }

        $this->publishes([
            __DIR__ . '/published/js/subscribe_manager.js' => public_path('packages/vis/subscribe_manager/subscribe_manager.js'),
        ], 'public');

        $this->publishes([
            __DIR__ . '/published/js/subscribe_manager_rules.js' => public_path('js/subscribe_manager_rules.js'),
        ], 'subscribe_manager_rules');


        /* $this->publishes([
            __DIR__.'/resources/views' => base_path('resources/views/partials/subscribe-manager'),
        ], 'subscribe-manager-view');*/

    }

    /**
     * Define the routes for the application.
     *
     * @param  \Illuminate\Routing\Router $router
     *
     * @return void
     */
    public function setupRoutes(Router $router)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/Http/Routes/routes.php';
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function provides()
    {
    }
}



