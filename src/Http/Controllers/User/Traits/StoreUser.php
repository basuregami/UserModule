<?php

namespace basuregami\UserModule\Http\Controllers\User\Traits;

use basuregami\UserModule\Events\UserCreated;
use basuregami\UserModule\Http\Request\User\StoreUserRequest;

trait StoreUser
{
    public function create()
    {

        $user = \Auth::user();
        if ($user->can('create', $user)) {
            $roles = $this->role->getAll();
            return view('usermodule::admin.users.create', compact('roles'));
        } else {
            return view('errors.401');
        }
    }

    
    public function store(StoreUserRequest $request)
    {
        $user = \Auth::user();
        if ($user->can('create', $user)) {
            try {
                $userStore['name'] = $request->name;
                $userStore['address'] = $request->address;
                $userStore['email'] = $request->email;
                $userStore['username'] = $request->username;
                $userStore['password'] = bcrypt($request->password);
                //dd($userStore);
                //dd($request->all());
                $role_id = $request->role_id;

                //create the new user
                $userCreated = $this->user->create($userStore);
                
                $userCreated->roles()->attach($role_id);
                
                //Create new userCreate Event
                event(new UserCreated($userCreated));

                return redirect('console/users')->with('status', "User Successfully Created");
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
