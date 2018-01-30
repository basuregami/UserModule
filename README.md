# UserModule

# Requirement 
    1) You need to install the admin panel backend theme template 
    
# Installation 
	
	 1. In order to install UserModule Package, just add the following to your composer.json  file in your fresh laravel              installation project. Then run  composer update

	   add this on composer require: "basuregami/UserModule": "dev-master"

	   add this repository to download the package: 

	   		"repositories": [
        		{
            		"type": "git",
            		"url":  "https://github.com/basuregami/UserModule.git" 
        		}
        	]
      
        and run the composer update command: "composer update" 
        and "php artisan vendor:publis"
        
     2. Register on the service provider on app.php file inside config folder

     	   Add this on provider on config.php provider array
       
     	    basuregami\UserModule\UserModuleServiceProvider::class,
            basuregami\UserModule\Providers\RouteServiceProvider::class,
            basuregami\UserModule\Providers\EventServiceProvider::class,


          Add laravel illuminate str on app.php aliases,
             'Str'       => 'Illuminate\Support\Str',


     3. Register the middleware on the kernel, kernel.php

            under  protected $routeMiddleware 

             'prevent-back-history' => \App\Http\Middleware\PreventBackHistory::class,
              'user-type' => \App\Http\Middleware\AdminMiddleware::class,

 			
     4. Register user model 

            Insider config/auth.php, update providers array with

            'providers' => [
                'users' => [
                    'driver' => 'eloquent',
                    'model' => basuregami\UserModule\Entities\User\User::class,
            ],

     5. Register the policy
            Insider the provider, AuthServiceProvider update protected $polices with

                 protected $policies = [
                    'App\Model' => 'App\Policies\ModelPolicy',
                    'basuregami\UserModule\Entities\User\User' => 'basuregami\UserModule\Policies\UserModelPolicy',
                    'basuregami\UserModule\Entities\Role\Role' => 'basuregami\UserModule\Policies\RoleModelPolicy',
                    'basuregami\UserModule\Entities\Permission\Permission' => 'basuregami\UserModule\Policies\PermissionModelPolicy',

                ]; 
    
    6. Package Seeder and migrations

            Update DatabaseSeeder.php file in seeds folder with

                  public function run()
                  {
                        $this->call(RolesTableSeeder::class);
                        $this->call(UsersTableSeeder::class);
                        $this->call(PermissionsTableSeeder::class);
                        $this->call(OperationTableSeeder::class);
                 }

    7. Package Routes

            1) login
                yourdomain/console

            2) User Module
                1) create user -> yourdomain//consoleuser/create
                2) view User -> yourdomain//consoleusers
                3) view profile -> yourdomain/console/user/profile

            3) Role Module

                1) create roles -> yourdomain/console/role/create
                2) view roles -> yourdomai/console/roles


            4) Permission Module

                1) create permission -> yourdomain/console/permission/create
                2) view permission -> yourdomain/console/permissions



    



