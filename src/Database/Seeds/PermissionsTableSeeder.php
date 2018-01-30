<?php
use Illuminate\Database\Seeder;
use basuregami\UserModule\Entities\Permission\Permission as Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(array(
            'name' => 'manage-user',
            'display_name' => 'User Management',
            'description' => 'System User Manger'
        ));

        Permission::create(array(
            'name' => 'manage-role',
            'display_name' => 'Role Management',
            'description' => 'Site Role Manager'
        ));

        Permission::create(array(
            'name' => 'manage-permission',
            'display_name' => 'Permission Management',
            'description' => 'Site Permission Manager'
        ));

    }
}