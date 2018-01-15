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

        //loading migrations
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        
        $this->loadViewsFrom(__DIR__.'/Resources/views','usermodule');

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
        //binding User Repo
        //bind the user repo
        $this->app->bind(
            'basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface',
            'basuregami\UserModule\Persistence\Repositories\UserRepository'
        );

    }

}
