<?php

namespace basuregami\UserModule\Http\Controllers\Permission;

use basuregami\UserModule\Http\Controllers\Controller;
use basuregami\UserModule\Http\Controllers\Permission\Traits\StorePermission;
use basuregami\UserModule\Http\Controllers\Permission\Traits\UpdatePermission;
use basuregami\UserModule\Http\Controllers\Permission\Traits\DeletePermission;
use basuregami\UserModule\Http\Controllers\Permission\Traits\PermissionRole;
use basuregami\UserModule\Persistence\Repositories\Contract\iPermissionInterface as PermissionRepository;
use basuregami\UserModule\Persistence\Repositories\Contract\iRoleInterface as RoleRepository;
use basuregami\UserModule\Entities\Permission\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    use StorePermission,
        UpdatePermission,
        DeletePermission,
        PermissionRole;

    public function __construct(PermissionRepository $permission,RoleRepository $role)
    {
        $this->permission = $permission;
        $this->role = $role;
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
        if ($user->can('view', $permission)) {
            return view('usermodule::admin.permissions.index');
        } else {
            return view('errors.401');
        }
    }
}
