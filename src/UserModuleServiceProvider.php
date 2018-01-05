<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/5/18
 * Time: 1:27 PM
 */

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
        $this->app->bind('UserModuleLoader',function(){
            return new UserModuleLoader;
        });
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