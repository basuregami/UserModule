<?php

namespace basuregami\UserModule\Http\Controllers\Role\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use basuregami\UserModule\Http\Request\Role\UpdateRoleRequest;
use basuregami\UserModule\Entities\Role\Role;
use Illuminate\Support\Str;

trait UpdateRole
{
	//show the form to edit specific role
    public function edit($id)
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('edit', $role)) {
            try {
                $role = null;
                $role = $this->role->findById(Crypt::decrypt($id));
                $operationPermissions =  $this->rolePermissionUpdate(Crypt::decrypt($id));

                return view("usermodule::admin.roles.edit",compact( ["role","operationPermissions"] ));
                
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return view('errors.401');
        }
        
    }

    //action route to edit/update specific role
    public function update(UpdateRoleRequest $request)
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('edit',$role)) {
            try {
                $id = Crypt::decrypt($request->id);
                $updateRoleData['name'] = $request->name;
                $updateRoleData['display_name'] = $request->display_name;
                $updateRoleData['description'] = $request->description;
                $slug = \Str::slug($request->display_name, '-');
                $updateRoleData['name'] = $slug;

                 // updated crud data
                $permissions = $request->crud;

                $this->role->update($updateRoleData, $id);
                /*
                * rolePermissionUpdateChange takes the  effect on the opeartionpermission table 
                * it takes the role id and permission id and update the corresponding opeartion filed 
                * rolePermissionUpdateChange is on the PermissionRole trait 
                */
                $this->rolePermissionUpdateChange($permissions, $id);
                return redirect()->back()->with('status',"Role Updated Successfully");
                

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