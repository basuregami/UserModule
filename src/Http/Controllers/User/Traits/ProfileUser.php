<?php

namespace basuregami\UserModule\Http\Controllers\User\Traits;

use basuregami\UserModule\Http\Request\User\ProfileUserRequest;

trait ProfileUser
{
    public function profile()
    {

        $user = \Auth::user();
        $id = $user->id;
        

            $user = null;
        try {
            $roles = $this->role->getAll();
            $user = $this->user->findById($id);
            return view("usermodule::admin.users.profile", compact(["user","roles"]));
        } catch (Exception $e) {
            return $e;
        }

        // if ($user->can('profile',$user)) {
           
        // }else{
        //     return view('errors.404');
        // }
    }

    public function updateProfile(ProfileUserRequest $request)
    {

        try {
             $user = \Auth::user();

              $id = $user->id;

                $updateUserData['name'] = $request->name;
                $updateUserData['address'] = $request->address;

                // update user
                $user = $this->user->update($updateUserData, $id);

                return redirect('console/user/profile')->with('status', "Your profile Updated Successfully");
        } catch (\Exception $e) {
            $environment  = config('app.env');
            if ($environment == 'local') {
                return view('errors.404', array('error' => $e->getMessage()));
            } else {
                return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
            }
        }
    }
}
