<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/12/18
 * Time: 10:20 AM
 */

namespace basuregami\UserModule\Listeners;
use basuregami\UserModule\Events\UserCreated;


class TestUserListner
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderShipped  $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
       $id = $event->user->getQueueableId();
       dd($id);
    }
}