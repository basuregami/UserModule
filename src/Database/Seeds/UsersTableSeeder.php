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
                'user_type' => 0,
                'status' => 0,
                'password' => bcrypt('admin123')
        ));

       $user->roles()->attach(1);
    }
}
