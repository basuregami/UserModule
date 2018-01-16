# UserModule

# Requirement 
    1) You need to delete your database migration presents in your fresh laravel installtion.
    2) You need to install the admin panel backend theme template 
    3) you need to delete the default route and install the update the route file present in the admin panel backend theme.
    
# Installation 
	
	 1. In order to install UserModule Package, just add the following to your composer.json file in your fresh laravel              installation project. Then run  composer update

	   add this on composer require: "basuregami/UserModule": "dev-master"

	   add this repository to download the package: 

	   		"repositories": [
        		{
            		"type": "git",
            		"url":  "https://github.com/basuregami/UserModule.git" 
        		}
        	]
      
        and run the composer update command: "composer update" 
        
     2. Register on the service provider on app.php file inside config folder

     	   Add this on provider on config.php provider array
       
     	 		basuregami\UserModule\UserModuleServiceProvider::class,
          basuregami\UserModule\Providers\RouteServiceProvider::class,
           basuregami\UserModule\Providers\EventServiceProvider::class,
 			
 		

 	    3. Testing package

 			    check yourdomain/userlist and yourdomain/userCreate Route

