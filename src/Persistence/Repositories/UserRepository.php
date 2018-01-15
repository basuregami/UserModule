<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/10/18
 * Time: 4:59 PM
 */

namespace basuregami\UserModule\Persistence\Repositories;


use basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface;

class UserRepository extends EloquentRepository implements iUserInterface
{
    protected $modelClassName = 'basuregami\UserModule\Entities\User\User';

}