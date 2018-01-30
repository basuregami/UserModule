<?php

use Illuminate\Database\Seeder;
use basuregami\UserModule\Entities\OperationPermission\OperationPermission as OperationPermission;

class OperationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //administrator
       OperationPermission::create(array(
            'role_id' => 1,
            'permission_id' => 1,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 1,
            'permission_id' => 2,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 1,
            'permission_id' => 3,
            'operation' => "on,on,on,on"
        ));
       //Editor
       OperationPermission::create(array(
            'role_id' => 2,
            'permission_id' => 1,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 2,
            'permission_id' => 2,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 2,
            'permission_id' => 3,
            'operation' => "on,on,on,on"
        ));

       //Author
       OperationPermission::create(array(
            'role_id' => 3,
            'permission_id' => 1,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 3,
            'permission_id' => 2,
            'operation' => "on,on,on,on"
        ));
       OperationPermission::create(array(
            'role_id' => 3,
            'permission_id' => 3,
            'operation' => "on,on,on,on"
        ));

       //Moderator
       OperationPermission::create(array(
            'role_id' => 4,
            'permission_id' => 1,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 4,
            'permission_id' => 2,
            'operation' => "on,on,on,on"
        ));

       OperationPermission::create(array(
            'role_id' => 4,
            'permission_id' => 3,
            'operation' => "on,on,on,on"
        ));

   
       //Subscriber
       OperationPermission::create(array(
            'role_id' => 5,
            'permission_id' => 1,
            'operation' => "on,on,on,on"
        ));

        OperationPermission::create(array(
            'role_id' => 5,
            'permission_id' => 2,
            'operation' => "on,on,on,on"
        ));

        OperationPermission::create(array(
            'role_id' => 5,
            'permission_id' => 3,
            'operation' => "on,on,on,on"
        ));

       

    }
}
