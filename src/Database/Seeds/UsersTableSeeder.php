<?php

use Illuminate\Database\Seeder;
use basuregami\UserModule\Entities\User\User as User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $user = User::create(array(
                'name' => 'superadmin',
                'username' => 'admin',
                'address' => 'admin',
                'email' => 'admin@admin.com',
                'is_superadmin' => 1,
                'user_type' => 1,
                'status' => 1,
                'password' => bcrypt('admin123')
        ));

       $user->roles()->attach(1);

       $user = User::create(array(
                'name' => 'Administrator',
                'username' => 'Administrator',
                'address' => 'Administrator',
                'email' => 'Administrator@Administrator.com',
                'is_superadmin' => 0,
                'user_type' => 1,
                'status' => 1,
                'password' => bcrypt('admin123')
        ));

       $user->roles()->attach(1);
    }
}
