<?php


use Illuminate\Database\Seeder;
use basuregami\UserModule\Entities\Role\Role as Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(array(
            'name' => 'administrator',
            'display_name' => 'Administrator',
            'description' => 'System admin'
        ));

        Role::create(array(
            'name' => 'editor',
            'display_name' => 'Editor',
            'description' => 'site editor'
        ));

        Role::create(array(
            'name' => 'author',
            'display_name' => 'Author',
            'description' => 'System author'
        ));

        Role::create(array(
            'name' => 'moderator',
            'display_name' => 'Moderator',
            'description' => 'System moderator'
        ));

        Role::create(array(
            'name' => 'subscriber',
            'display_name' => 'Subscriber',
            'description' => 'System subscriber'
        ));
    }
}