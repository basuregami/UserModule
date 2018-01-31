<?php

Route::group(['prefix'=>'console','middleware'=>['auth','prevent-back-history']], function () {

         Route::get('/users', [
                'uses' => 'User\UserController@show',
                'as' => 'users.show'
            ]);

            Route::post('/userAjaxList', [
                'uses' => 'User\UserController@ajaxUserList',
                'as' => 'users.ajaxUserList'
            ]);

            Route::get('/user/create', [
                'uses' => 'User\UserController@create',
                'as' => 'users.create'
            ]);

            Route::post('/userCreate', [
                'uses' => 'User\UserController@store',
                'as' => 'users.store'
            ]);
          
            Route::get('/user/edit/{id}', [
                'uses' => 'User\UserController@edit',
                'as' => 'users.edit'
            ]);

            Route::post('/updateUser', [
                'uses' => 'User\UserController@update',
                'as' => 'users.update'
            ]);

            Route::post('/user/delete', [
                'uses' => 'User\UserController@destory',
                'as' => 'users.delete'
            ]);

            Route::post('/deleteMultipleUser', [
                'uses' => 'User\UserController@multipleDelete',
            ]);

            Route::get('/user/update/password', [
                'uses' => 'User\UserController@updatepassword',
                'as' => 'users.update.password'
            ]);

            Route::post('/update/password', [
                'uses' => 'User\UserController@updatePasswordPost',
                'as' => 'users.update.password.post'
            ]);

            Route::get('/user/profile/', [
                'uses' => 'User\UserController@profile',
                'as' => 'user.profile'
            ]);

            Route::post('/user/profile/', [
                'uses' => 'User\UserController@updateProfile',
                'as' => 'user.profile'
            ]);

});
