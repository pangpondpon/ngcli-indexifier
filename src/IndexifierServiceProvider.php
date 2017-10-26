<?php

namespace Indexifier;

use Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Indexifier\Classes\Indexifier;

class IndexifierServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $this->publishes([
            __DIR__.'/Config/indexifier.php' => config_path('indexifier.php'),
        ], 'indexifier_config');
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

        $this->registerIndexifierBladeDirective();
    }

    private function registerIndexifierBladeDirective()
    {
        Blade::directive('ngStyle', function ($prefix) {
            return (new Indexifier)->fetchStyle();
        });

        Blade::directive('ngScripts', function ($prefix) {
            return (new Indexifier)->fetchScripts();
        });
    }
}
