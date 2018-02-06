<?php

namespace basuregami\UserModule\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use basuregami\UserModule\Entities\OperationPermission\OperationPermission;
use basuregami\UserModule\Entities\User\User;

class UserModelPolicy
{
    use HandlesAuthorization;

    public function operation($user)
    {
        $role = $user->roles->first()->id;
        $permission = 1;

        $operationPermission = OperationPermission::where('role_id', $role)
            ->where('permission_id', $permission)
            ->first()
            ->operation;


        $operationPermission = explode(',', $operationPermission);

        return $operationPermission;
    }

    /**
      * Determine whether the user can create posts.
      *
      * @param  \App\User  $user
      * @return mixed
    */
    public function create(User $user)
    {
        $operationPermission = $this->operation($user);

        if ($operationPermission[0] == 'on') {
            return true;
        }
        return false;

    }
     
 
    /**
      * Determine whether the user can view the post.
      *
      * @param  \App\User  $user
      * @param  \App\Post  $post
      * @return mixed
    */
    public function view(User $user)
    {
        $operationPermission = $this->operation($user);

        if ($operationPermission[1] == 'on') {
            return true;
        }
        return false;

    }
     
    
    /**
      * Determine whether the user can update the post.
      *
      * @param  \App\User  $user
      * @param  \App\Post  $post
      * @return mixed
    */
    public function update(User $user)
    {
        $operationPermission = $this->operation($user);

        if ($operationPermission[2] == 'on') {
            return true;
        }
        return false;

    }
     
    /**
      * Determine whether the user can delete the post.
      *
      * @param  \App\User  $user
      * @param  \App\Post  $post
      * @return mixed
    */
    public function delete(User $user)
    {

        $operationPermission = $this->operation($user);

        if ($operationPermission[3] == 'on') {
            return true;
        }
        return false;
    }
}
