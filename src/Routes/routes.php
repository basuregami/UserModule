<?php


Route::get('/products', function () {

    return "hello from vendor";
    //return view('usermodule::index');
    //return demo_package()->index();
});


Route::get('/controllertest','basuregami\UserModule\Http\Controllers\User\UserController@test');

