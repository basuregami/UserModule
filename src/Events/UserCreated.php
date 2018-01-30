<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/12/18
 * Time: 10:17 AM
 */

namespace basuregami\UserModule\Events;

use basuregami\UserModule\Entities\User\User;
use Illuminate\Queue\SerializesModels;

class UserCreated
{
    use SerializesModels;

    public $user;

    /**
     * Create a new event instance.
     *
     * @param  Order  $order
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }
}
