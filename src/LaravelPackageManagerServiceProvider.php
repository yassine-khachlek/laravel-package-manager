<?php

namespace Yk\LaravelPackageManager;

use Illuminate\Support\ServiceProvider;
use Config;

class LaravelPackageManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return  void
     */
    public function boot()
    {
        $this->app->router->group(['namespace' => 'Yk\LaravelPackageManager\App\Http\Controllers', 'prefix' => Config::get('vendor.yk.laravel-package-manager.route.prefix'), 'middleware' => ['web']], 
            function(){
                require __DIR__.'/routes/web.php';
            }
        );

        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk/LaravelPackageManager');


        $this->publishes([
            __DIR__.'/config' => config_path('vendor/yk/laravel-package-manager'),
        ], 'config');
    }
    
    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/config/package.php',
            'vendor.yk.laravel-package-manager.package'
        );

        $this->mergeConfigFrom(
            __DIR__.'/config/route.php',
            'vendor.yk.laravel-package-manager.route'
        );
    }
}