<?php

namespace basuregami\UserModule\Http\Controllers\User;

use basuregami\UserModule\Http\Controllers\Controller;
use basuregami\UserModule\Http\Request\User\StoreUserRequest;
use basuregami\UserModule\Events\UserCreated;
use basuregami\UserModule\Persistence\Repositories\Contract\iUserInterface as UserRepository;

class UserController extends Controller
{

    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    public function index()
    {
        $users = $this->user->getAll();
        return view('usermodule::admin.users.index')->with(['users' => $users]);
//       return "from index ";
//        try {
//            dd('testubg ubdex');
//            $users = $this->getAll();
//            return view('usermodule::admin.users.create');
//        } catch (\Exception $e) {
//
//            $environment = config('app.env');
//
//            if ($environment == 'local') {
//                return view('errors.custom', array('error' => $e->getMessage()));
//            } else {
//                return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
//            }
//
//        }

    }

    public function create(){
        return view('usermodule::admin.users.create');

    }

    public function store(StoreUserRequest $request){

        $user['name'] = $request->name;
        $user['email'] = $request->email;
        $user['password'] = $request->password;

       try{
            $user = $this->user->create($user);

            event(new UserCreated($user));

            return redirect()->back();

       }catch(\Exception $e){
           $environment  = config('app.env');
           if ($environment == 'local') {
               return view('errors.custom',array('error' => $e->getMessage()));
           }else{
               return redirect()->back()->withErrors(['errorMessage' => $e->getMessage()]);
           }
       }


        return redirect()->back();
    }

    public function show(){

    }

    public function edit(){

    }

    public function update(){

    }

    public function destory(){

    }

}