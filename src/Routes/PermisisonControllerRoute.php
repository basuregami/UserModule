<?php

Route::group(['prefix'=>'console','middleware'=>['auth','prevent-back-history']],function(){

    Route::get('/permissions', [
        'uses' => 'Permission\PermissionController@show',
        'as' => 'permissions.show'
    ]);

    Route::post('/permissionAjaxList', [
        'uses' => 'Permission\PermissionController@ajaxPermissionList',
        'as' => 'permissions.ajaxPermissionList'
    ]);
    
    Route::get('/permission/create', [
        'uses' => 'Permission\PermissionController@create',
        'as' => 'permissions.create'
    ]);

    Route::post('/permissionCreate', [
        'uses' => 'Permission\PermissionController@store',
        'as' => 'permissions.store'
    ]);

    Route::get('/permission/edit/{id}', [
        'uses' => 'Permission\PermissionController@edit',
        'as' => 'permissions.edit'
    ]);

    Route::post('/updatePermission', [
        'uses' => 'Permission\PermissionController@update',
        'as' => 'permissions.update'
    ]);

    Route::post('/permission/delete', [
        'uses' => 'Permission\PermissionController@destroy',
        'as' => 'permissions.delete'
    ]);

    Route::post('/deleteMultiplePermission',[
        'uses' => 'Permission\PermissionController@multipleDelete',
    ]);

});




