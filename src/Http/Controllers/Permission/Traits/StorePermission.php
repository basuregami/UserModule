<?php

namespace basuregami\UserModule\Http\Controllers\Permission\Traits;

use basuregami\UserModule\Entities\Permission\Permission;
use basuregami\UserModule\Http\Request\Permission\StorePermissionRequest;

trait StorePermission
{
    //show the form to create/add/store new role
    public function create()
    {
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('create', $permission)) {
            $permissions = $this->permission->getAll();
            return view('usermodule::admin.permissions.create', compact("permissions"));
        } else {
            return view('errors.401');
        }
    }

    
    //action route to create/add/store new role
    public function store(StorePermissionRequest $request)
    {
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('create', $permission)) {
            try {
                $storePermission['display_name'] = $request->display_name;
                $storePermission['description'] = $request->description;
                $slug = \Str::slug($request->display_name, '-');
                $storePermission['name'] = $slug;

                //create the new permission
                $this->permission->create($storePermission);
                return redirect('console/permissions')->with('status', 'Permission Created');
            } catch (\Exception $e) {
                return $e;
                $environment  = config('app.env');
                if ($environment == 'local') {
                    return view('errors.404', array('error' => $e->getMessage()));
                } else {
                    return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
                }
            }
        } else {
            return view('errors.401');
        }
    }
}
