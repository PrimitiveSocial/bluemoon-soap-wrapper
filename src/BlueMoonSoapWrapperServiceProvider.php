<?php

namespace PrimitiveSocial\BlueMoonSoapWrapper;

use Illuminate\Support\ServiceProvider;

class BlueMoonSoapWrapperServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'primitivesocial');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'primitivesocial');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }

        $this->publishes([
            __DIR__ . '../config/bluemoon.php' => config_path('bluemoon.php'),
        ]);
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/bluemoonsoapwrapper.php', 'bluemoonsoapwrapper');

        // Register the service the package provides.
        $this->app->singleton('bluemoonsoapwrapper', function ($app) {
            return new BlueMoonSoapWrapper;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['bluemoonsoapwrapper'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/bluemoonsoapwrapper.php' => config_path('bluemoonsoapwrapper.php'),
        ], 'bluemoonsoapwrapper.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/primitivesocial'),
        ], 'bluemoonsoapwrapper.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/primitivesocial'),
        ], 'bluemoonsoapwrapper.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/primitivesocial'),
        ], 'bluemoonsoapwrapper.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
