<?php

namespace basuregami\UserModule\Http\Controllers\User\Traits;

use basuregami\UserModule\Http\Request\User\UpdatePasswordRequest;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


trait UpdatePassword
{
    public function updatepassword($id)
    {

        $user = null;
        $id = Crypt::decrypt($id);
        $id = (int) $id;
        try {
            $user = $this->user->findById($id);

        } catch (\Exception $e) {
            $environment  = config('app.env');
            if ($environment == 'local') {
                return view('errors.404', array('error' => $e->getMessage()));
            } else {
                return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
            }
        }
        return view("usermodule::admin.users.updatePassword", compact("user"));


    }

    public function updatePasswordPost(UpdatePasswordRequest $request)
    {
        try {

            if ( $this->checkOldPassword($request) ){

                $id = $request->id;
                $user['password'] = bcrypt($request->password);

                //update user
                $this->user->update($user, $id);

                return back()->with('status',"Password Changed Successfully");

            }else{

                return back()->withErrors(['error' => 'Password Credentials did not match ']);
            }

        } catch (\Exception $e) {
            $environment  = config('app.env');

            if ($environment == 'local') {
                return view('errors.404', array('error' => $e->getMessage()));
            } else {
                return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
            }
        }

    }

    public function checkOldPassword($request)
    {
        $old_password = $request->old_password;

        return Hash::check($old_password, \Auth::user()->password);

    }

}
