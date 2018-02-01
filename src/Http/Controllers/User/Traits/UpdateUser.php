<?php

namespace basuregami\UserModule\Http\Controllers\User\Traits;

use Illuminate\Support\Facades\Crypt;
use basuregami\UserModule\Http\Request\User\UpdateUserRequest;

trait UpdateUser
{
    public function edit($id)
    {
        $user = \Auth::user();
        if ($user->can('update', $user)) {
            $user = null;
            try {
                $roles = $this->role->getAll();
                $user = $this->user->findById(Crypt::decrypt($id));
                return view("usermodule::admin.users.edit", compact(["user","roles"]));
            } catch (Exception $e) {
                return $e;
            }
        } else {
            return view('errors.401');
        }
    }

    public function update(UpdateUserRequest $request)
    {
        $user = \Auth::user();
        if ($user->can('update', $user)) {
            try {
                    $id = $request->id;

                    $updateUserData['name'] = $request->name;
                    $updateUserData['address'] = $request->address;
                    $updateUserData['status'] = $request->status;
                    $roleId = $request->role_id;
                    $updateAttributes = [
                        'role_id' => $roleId,
                    ];
                    $userPivot = $this->user->findById($id);

                    foreach ($userPivot->roles as $role) {
                        $prevRoleId = $role->id;
                    }
                    //update role
                    $userPivot->roles()->updateExistingPivot($prevRoleId, $updateAttributes);

                    // update user
                    $user = $this->user->update($updateUserData, $id);

                    return redirect('console/users')->with('status', "User Detail Updated Successfully");
            } catch (\Exception $e) {
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
