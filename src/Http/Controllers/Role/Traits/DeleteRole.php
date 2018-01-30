<?php

namespace basuregami\UserModule\Http\Controllers\Role\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use basuregami\UserModule\Entities\Role\Role;

trait DeleteRole
{
	 //action route to delete the specific role
    public function destroy(Request $request)
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('delete',$role)) {
            try {
                $role_id = Crypt::decrypt($request['roleId']);
                if($this->role->delete($role_id)){
                    return "successfully deleted";
                }
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return view('errors.401');
        }

    }


    //action route to multiple delete roles
    public function multipleDelete(Request $request)
    {
        $user = \Auth::user();
        $role = new Role();
        if ($user->can('delete',$role)) {
            try { 
                $data_ids = $_REQUEST['data_ids'];
                $data_id_array = explode(",", $data_ids);
                $this->role->delete($data_id_array);
                 return "successfully deleted";
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return view('errors.401');
        }

        

       
    }   

}