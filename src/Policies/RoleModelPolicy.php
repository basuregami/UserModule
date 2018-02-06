<?php
/**
 * Created by PhpStorm.
 * User: basu
 * Date: 1/29/18
 * Time: 12:22 PM
 */


namespace basuregami\UserModule\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use basuregami\UserModule\Entities\OperationPermission\OperationPermission;
use basuregami\UserModule\Entities\User\User;
use basuregami\UserModule\Entities\Role\Role;

class RoleModelPolicy
{
    use HandlesAuthorization;

    public function operation($user)
    {
        $role = $user->roles->first()->id;
        $permission = 2;

        $operationPermission = OperationPermission::where('role_id', $role)
            ->where('permission_id', $permission)
            ->first()
            ->operation;


        $operationPermission = explode(',', $operationPermission);
        //dd($operationPermission);
        return $operationPermission;
    }

    /**
     * Determine whether the user can create posts.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user, Role $role)
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
    public function view(User $user, Role $role)
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
    public function edit(User $user, Role $role)
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
    public function delete(User $user, Role $role)
    {
        $operationPermission = $this->operation($user);

        if ($operationPermission[3] == 'on') {
            return true;
        }
        return false;
    }
}
