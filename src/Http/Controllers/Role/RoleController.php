<?php

namespace basuregami\UserModule\Http\Controllers\Role;

use basuregami\UserModule\Http\Controllers\Controller;
use basuregami\UserModule\Persistence\Repositories\Contract\iRoleInterface as RoleRepository;
use basuregami\UserModule\Persistence\Repositories\Contract\iPermissionInterface as PermissionRepository;
use basuregami\UserModule\Http\Controllers\Role\Traits\StoreRole;
use basuregami\UserModule\Http\Controllers\Role\Traits\UpdateRole;
use basuregami\UserModule\Http\Controllers\Role\Traits\DeleteRole;
use basuregami\UserModule\Http\Controllers\Role\Traits\PermissionRole;
use Illuminate\Http\Request;
use basuregami\UserModule\Entities\Role\Role;

class RoleController extends Controller
{
    use StoreRole,
        UpdateRole,
        DeleteRole,
        PermissionRole;

    public function __construct(RoleRepository $role, PermissionRepository $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    //show the listing of available roles
    public function index()
    {
        return view('usermodule::admin.roles.index');
    }
    

    public function ajaxRoleList(Request $request)
    {
        return $this->role->getListDataTable($request);
    }

   
    //show the form to create/add/store new role
    public function show()
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('view', $role)) {
            return view('usermodule::admin.roles.index');
        } else {
            return view('errors.401');
        }
    }
}
