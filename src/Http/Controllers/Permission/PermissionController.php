<?php

namespace basuregami\UserModule\Http\Controllers\Permission;

use basuregami\UserModule\Http\Controllers\Controller;
use basuregami\UserModule\Http\Request\User\StoreUserRequest;
use basuregami\UserModule\Http\Request\User\UpdateUserRequest;
use basuregami\UserModule\Http\Controllers\Permission\Traits\StorePermission;
use basuregami\UserModule\Http\Controllers\Permission\Traits\UpdatePermission;
use basuregami\UserModule\Http\Controllers\Permission\Traits\DeletePermission;
use basuregami\UserModule\Events\UserCreated;
use basuregami\UserModule\Persistence\Repositories\Contract\iPermissionInterface as PermissionRepository;
Use basuregami\UserModule\Entities\Permission\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;



class PermissionController extends Controller
{
   use StorePermission,
        UpdatePermission,
        DeletePermission;

    public function __construct(PermissionRepository $permission)
    {
        $this->permission = $permission;
    }

    //show the listing of available roles
    public function index()
    {
        return view('usermodule::admin.permissions.index');
    }

    public function ajaxPermissionList(Request $request)
    {
        return $this->permission->getListDataTable($request);

    }
   
    //show the form to create/add/store new role
    public function show()
    {
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('view',$permission)) {
            return view('usermodule::admin.permissions.index');
        }else{
            return view('errors.401');
        }
    }

  
 

}
