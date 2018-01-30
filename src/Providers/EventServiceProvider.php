<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/12/18
 * Time: 10:11 AM
 */

namespace basuregami\UserModule\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'basuregami\UserModule\Events\UserCreated' => [
            'basuregami\UserModule\Listeners\TestUserListner',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
