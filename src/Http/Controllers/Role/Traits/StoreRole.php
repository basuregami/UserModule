<?php

namespace basuregami\UserModule\Http\Controllers\Role\Traits;
use Illuminate\Http\Request;
use basuregami\UserModule\Entities\Role\Role;
use basuregami\UserModule\Http\Request\Role\StoreRoleRequest;
use Illuminate\Support\Str;


trait StoreRole
{

    //show the form to create/add/store new role
    public function create()
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('create',$role)) {
            $permissions = $this->permission->getAll();
            return view('usermodule::admin.roles.create', compact("permissions") );
        }else{
            return view('errors.401');
        }

}

	
    //action route to create/add/store new role
    public function store(StoreRoleRequest $request)
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('create',$role)) {
            try {
                $storeRole['display_name'] = $request->display_name;
                $storeRole['description'] = $request->description;
                $slug = \Str::slug($request->display_name, '-');
                $storeRole['name'] = $slug;

                //role permissioon
                $permission = $request->crud;

                //create the new user
                $role = $this->role->create($storeRole);
                $role_id = $role->id;
                
                $this->rolePermission($permission, $role_id);
                return redirect('console/roles')->with('status',"Role Successfully Created");
                
            } catch (\Exception $e) {
                return $e;
                $environment  = config('app.env');
                if ($environment == 'local') {
                    return view('errors.404', array('error' => $e->getMessage()));
                } else {
                    return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
                }
            }
        }else{
            return view('errors.401');
        }
    }

}