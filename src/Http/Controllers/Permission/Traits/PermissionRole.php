<?php

namespace basuregami\UserModule\Http\Controllers\Permission\Traits;

use basuregami\UserModule\Entities\Role\Role as Role;
use basuregami\UserModule\Entities\OperationPermission\OperationPermission as OperationPermission;

trait PermissionRole
{
    /*Role Permission Create*/
    public function PermissionRole($permission_id)
    {

        $roles = $this->role->getAll();
        foreach ($roles as $role_id) {
            $id = $role_id->id;
            $operation = 'off,off,off,off';
            $data = [
                'role_id' => $id,
                'permission_id' => $permission_id,
                'operation' => $operation
            ];

            OperationPermission::create($data);
        }
        return;
    }
}
