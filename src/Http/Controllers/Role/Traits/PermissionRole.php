<?php

namespace basuregami\UserModule\Http\Controllers\Role\Traits;
use Illuminate\Http\Request;
use basuregami\UserModule\Entities\Role\Role as Role;
use basuregami\UserModule\Entities\OperationPermission\OperationPermission as OperationPermission;

trait PermissionRole
{
	// role permission get data edit
	public function rolePermissionUpdate($role_id)
	{
		$operationPermissions = Role::find($role_id)->OperationPermission;
		return $operationPermissions;
	}

	/*Role permission post update data*/
	public function rolePermissionUpdateChange($permissions, $role_id)
	{
		foreach ($permissions as $id => $value) {

			$permission_id = $id;
			$operation = implode(",", $value);

			$data = [
				'role_id' => $role_id,
				'permission_id' => $permission_id,
				'operation' => $operation
			];
			$OperationPermissionUpdate = OperationPermission::where('permission_id', $permission_id)
				->where('role_id', $role_id)
              	->update($data);
		}
		return; 
		
	}
	/*Role Permission Create*/
	public function rolePermission($permission, $role_id)
	{
		foreach ($permission as $id => $value) {

			$permission_id = $id;
			$operation = implode(",", $value);

			$data = [
				'role_id' => $role_id,
				'permission_id' => $permission_id,
				'operation' => $operation
			];
			
			OperationPermission::create($data);
		}
		return; 
		
	}


}