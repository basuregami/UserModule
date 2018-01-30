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

        //loading views
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'usermodule');

        //publishing database file
        $this->publishDatabases();

        //publishing views file
        $this->publishViews();

        //publishing middelware file
        $this->publishMiddlewares();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //loading migrations
        //$this->loadMigrationsFrom(__DIR__.'/Database/Migrations');


        //bind the user repo
        $this->app->bind(
            'basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface',
            'basuregami\UserModule\Persistence\Repositories\UserRepository'
        );


        //bind role repository
        $this->app->bind(
            'basuregami\UserModule\Persistence\Repositories\Contract\iRoleInterface',
            'basuregami\UserModule\Persistence\Repositories\RoleRepository'
        );

        //bind permission repository
        $this->app->bind(
            'basuregami\UserModule\Persistence\Repositories\Contract\iPermissionInterface',
            'basuregami\UserModule\Persistence\Repositories\PermissionRepository'
        );
    }

    /**
    * Publishes Database related class to main application
    * @includes database migrations
    * @includes database seeder
    * @includes database factory
    */

    public function publishDatabases()
    {
        //migration
        $this->publishes([
            __DIR__.'/Database/Migrations' => base_path('database/migrations')
        ]);

        //seeder
        $this->publishes([
            __DIR__.'/Database/Seeds' => base_path('database/seeds')
        ]);

        //database factory
         $this->publishes([
            __DIR__.'/Database/Factories' => base_path('database/factories')
         ]);
    }

    /**
    * Publishes views related file to main application
    * @includes usermodule views
    */

    public function publishViews()
    {
        //migration
        $this->publishes([
            __DIR__.'/Resources/views' => base_path('resources/views/vendor/usermodule')
        ]);
    }

    /**
    * Publishes views related file to main application
    * @includes usermodule views
    */

    public function publishMiddlewares()
    {
         //middleware publish
        $this->publishes([
            __DIR__.'/Http/Middleware' => base_path('app/Http/Middleware')
        ]);
    }
}
