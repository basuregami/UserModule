<?php

namespace basuregami\UserModule\Http\Controllers\Permission\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use basuregami\UserModule\Entities\Permission\Permission;
use basuregami\UserModule\Http\Request\Permission\UpdatePermissionRequest;
use Illuminate\Support\Str;


trait UpdatePermission
{
	  //show the form to edit specific role
    public function edit($id)
    {
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('edit',$permission)) {
            try {
                $permission = null;
                $permission = $this->permission->findById(Crypt::decrypt($id));
                return view("usermodule::admin.permissions.edit",compact("permission"));
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return view('errors.401');
        }

    }

    //action route to edit/update specific role
    public function update(UpdatePermissionRequest $request)
    {
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('edit',$permission)) {

            try {

                $id =$request->id;
                $updatePermission['display_name'] = $request->display_name;
                $updatePermission['description'] = $request->description;
                $slug = \Str::slug($request->display_name, '-');
                $updatePermission['name'] = $slug;
                $this->permission->update($updatePermission, $id);

                return redirect('console/permissions')->with('status','Permission Succesfully Update');
                
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