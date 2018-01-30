<?php

Route::group(['prefix'=>'console','middleware'=>['auth','prevent-back-history']],function(){

         Route::get('/roles', [
                'uses' => 'Role\RoleController@show',
                'as' => 'roles.show'
            ]);

            Route::post('/roleAjaxList', [
                'uses' => 'Role\RoleController@ajaxRoleList',
                'as' => 'roles.ajaxRoleList'
            ]);

            Route::get('/role/create', [
                'uses' => 'Role\RoleController@create',
                'as' => 'roles.create'
            ]);

            Route::post('/roleCreate', [
                'uses' => 'Role\RoleController@store',
                'as' => 'roles.store'
            ]);
          
            Route::get('/role/edit/{id}', [
                'uses' => 'Role\RoleController@edit',
                'as' => 'roles.edit'
            ]);

            Route::post('/updateRole', [
                'uses' => 'Role\RoleController@update',
                'as' => 'roles.update'
            ]);

            Route::post('/role/delete', [
                'uses' => 'Role\RoleController@destroy',
                'as' => 'roles.delete'
            ]);

            Route::post('/deleteMultipleRole',[
                'uses' => 'Role\RoleController@multipleDelete',
            ]);


            Route::post('/rolepermission/update',[
                'uses' => 'Role\RoleController@rolePermissionUpdate',
                'as' => 'roles.permission.update'
            ]);

});
           



