<?php

namespace Indexifier;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class IndexifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('indexifier', \Indexifier\Middleware\IndexifierMiddleware::class);

        $this->publishes([
            __DIR__.'/Config/indexifier.php' => config_path('indexifier.php'),
        ], 'indexifier_config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'indexifier');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/indexifier'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'indexifier');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/indexifier'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/indexifier'),
        ], 'indexifier_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Indexifier\Commands\IndexifierCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/indexifier.php', 'indexifier'
        );
    }
}
