<?php
namespace basuregami\UserModule;

use Illuminate\Support\ServiceProvider;

class UserModuleServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // if (! $this->app->routesAreCached()) {
        // 	require __DIR__.'/Routes/routes.php';
        // }
        $this->loadRoutesFrom(__DIR__.'/Routes/routes.php');
        //loading views
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        
        $this->loadViewsFrom(__DIR__.'/Resources/views','usermodule');
        // $this->loadViewsFrom(base_path('resources/views/vendor/usermodule'),'usermodule');

        //$this->loadMigrationsFrom(base_path('database/migrations'));

        // $this->publishes([
        //     __DIR__.'/Routes' => base_path('routes/vendor/UserModule')
        // ]);
        $this->publishes([
        	__DIR__.'/Resources/views' => base_path('resources/views/vendor/usermodule')
        ]);

        $this->publishes([
        	__DIR__.'/Database/Migrations' => base_path('database/migrations')
        ]);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
