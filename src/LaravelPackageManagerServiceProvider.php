<?php

namespace Yk\LaravelPackageManager;

use Illuminate\Support\ServiceProvider;

class LaravelPackageManagerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return  void
     */
    public function boot()
    {
        $this->app->router->group(['namespace' => 'Yk\LaravelPackageManager\App\Http\Controllers', 'prefix' => 'packages'],
            function(){
                require __DIR__.'/routes/web.php';
            }
        );
        

        $this->loadViewsFrom(__DIR__.'/resources/views', 'Yk/LaravelPackageManager');

        /*
        $this->publishes(
            [
                __DIR__.'/resources/views' => base_path('resources/views/vendor/Yk/LaravelPackageManager'),
            ]
        );

        $this->publishes([
            __DIR__.'/public' => public_path('vendor/Yk/LaravelPackageManager'),
        ], 'public');

        $this->publishes([
            __DIR__.'/config' => config_path('vendor/Yk/LaravelPackageManager'),
        ]);

        $kernel = $this->app['Illuminate\Contracts\Http\Kernel'];
        
        $kernel->pushMiddleware('Yk\LaravelPackageManager\App\Http\Middleware\MiddlewareYkLaravelPackageManager');

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Yk\LaravelPackageManager\App\Console\Commands\YkLaravelPackageManager::class,
            ]);
        }
        */
    }
    
    /**
     * Register the application services.
     *
     * @return  void
     */
    public function register()
    {
        /*
        $this->mergeConfigFrom(
            __DIR__.'/config/app.php', 'packages.Yk.LaravelPackageManager.app'
        );

        $this->app->bind('YkLaravelPackageManager', function(){
            return $this->app->make('Yk\LaravelPackageManager\Classes\YkLaravelPackageManager');
        });
        */
    }
}