<?php

namespace basuregami\UserModule\Http\Controllers\User\Traits;

use Illuminate\Http\Request;

trait DeleteUser
{
    public function destory(Request $request)
    {
        $user = \Auth::user();
        if ($user->can('delete', $user)) {
            if ($this->user->delete($request['userId'])) {
                return back()->with('status', "User Successfully Deleted!!");
            } else {
                return back()->withErrors(['error' => 'User could not be deleted']);
            }
        } else {
            return view('errors.401');
        }
    }

    public function multipleDelete(Request $request)
    {
        $user = \Auth::user();
        if ($user->can('delete', $user)) {
            $data_ids = $_REQUEST['data_ids'];
            $data_id_array = explode(",", $data_ids);
            try {
                $this->user->delete($data_id_array);
                 return back()->with('status', "User Successfully Deleted!!");
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return view('errors.401');
        }
    }
}
