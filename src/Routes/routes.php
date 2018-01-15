<?php


Route::get('/userList',[
    'uses' => 'User\UserController@index',
    'as' => 'users.index'
]);

Route::get('/userCreate',[
    'uses' => 'User\UserController@create',
    'as' => 'users.create'
]);

Route::post('/userCreate',[
    'uses' => 'User\UserController@store',
    'as' => 'users.store'
]);

Route::get('/users',[
    'uses' => 'User\UserController@show',
    'as' => 'users.show'
]);

Route::get('/editUser/{anything}',[
    'uses' => 'User\UserController@edit',
    'as' => 'users.edit'
]);

Route::post('/updateUser',[
    'uses' => 'User\UserController@update'
]);

Route::post('/deleteUser',[
    'uses' => 'User\UserController@destroy'
]);





