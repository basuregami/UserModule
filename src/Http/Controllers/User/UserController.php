<?php

namespace basuregami\UserModule\Http\Controllers\User;

use basuregami\UserModule\Http\Controllers\Controller;
use basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface as UserRepository;
use basuregami\UserModule\Persistence\Repositories\Contract\iRoleInterface as RoleRepository;
use Illuminate\Http\Request;
use basuregami\UserModule\Http\Controllers\User\Traits\UpdatePassword;
use basuregami\UserModule\Http\Controllers\User\Traits\ProfileUser;
use basuregami\UserModule\Http\Controllers\User\Traits\StoreUser;
use basuregami\UserModule\Http\Controllers\User\Traits\UpdateUser;
use basuregami\UserModule\Http\Controllers\User\Traits\DeleteUser;

class UserController extends Controller
{
    use UpdatePassword,
        StoreUser,
        UpdateUser,
        DeleteUser,
        ProfileUser;

    public function __construct(UserRepository $user, RoleRepository $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
    }

    public function ajaxUserList(Request $request)
    {
        return $this->user->getListDataTable($request);
    }


    public function show()
    {

         $user = \Auth::user();
        if ($user->can('view', $user)) {
               return view('usermodule::admin.users.index');
        } else {
            return view('errors.401');
        }
    }
}
