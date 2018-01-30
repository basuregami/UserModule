<?php

namespace basuregami\UserModule\Http\Controllers\Permission\Traits;
use Illuminate\Http\Request;
use basuregami\UserModule\Entities\Permission\Permission;
use Illuminate\Support\Facades\Crypt;

trait DeletePermission
{
	   //action route to delete the specific role
    public function destroy(Request $request)
    {   
        $user = \Auth::user();
        $permission = new Permission();
        if ($user->can('delete',$permission)) {
            try{
                if($this->permission->delete(Crypt::decrypt($request['permissionId']))){
                    return "successfully deleted";
                }else{
                    return "Permission cannot be deleted.";
                }
            }catch(\Exception $e){
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
        $permission = new Permission();
        if ($user->can('delete',$permission)) {
            try {
                $data_ids = $_REQUEST['data_ids'];
                $data_id_array = explode(",", $data_ids);
         
                if ($this->permission->delete($data_id_array)) {
                   return "successfully deleted";
                }else{
                    return "Permission cannot be deleted.";
                }
            } catch (Exception $e) {
                return $e;
            }
        }else{
            return view('errors.401');
        }

    }

}
