<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'console'], function () {
    
    Route::get('/dashboard', 'HomeController@index')->name('home');


    Route::get('/register', [
        'uses' => 'Auth\LoginController@showLoginForm',
        'as' => 'register'
    ]);

    Route::get('/', [
        'uses' => 'Auth\LoginController@showLoginForm',
        'as' => 'login'
    ]);

    Route::post('/', [
        'uses' => 'Auth\LoginController@login',
    ])->middleware('user-type');

    Route::post('/logout', [
        'uses' => 'Auth\LoginController@logout',
        'as' => 'logout'
    ]);

     Route::get('/password/reset', [
        'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm',
        'as' => 'password.request'
     ]);

    Route::post('/password/email', [
        'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail',
        'as' => 'password.email'
    ]);

    Route::post('/password/reset', [
        'uses' => 'Auth\ResetPasswordController@reset'
    ]);


    Route::get('/password/reset/{token}', [
        'uses' => 'Auth\ResetPasswordController@showResetForm',
        'as' => 'password.reset'
    ]);
});
