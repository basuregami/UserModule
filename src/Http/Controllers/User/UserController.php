<?php

namespace basuregami\UserModule\Http\Controllers\User;

use basuregami\UserModule\Http\Controllers\Controller;

class UserController extends Controller
{
	
	// function __construct(argument)
	// {
	// 	# code...
	// }


	public function test(){
		  return view('usermodule::index');
	}
}