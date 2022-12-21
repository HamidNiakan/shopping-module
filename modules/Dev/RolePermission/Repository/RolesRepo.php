<?php

namespace Dev\RolePermission\Repository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesRepo {
	public function all () {
		return Role::all();
	}
	
	public function create ( Request $request ) {
		return Role::create([ 'name' => $request->name ])
				   ->syncPermissions($request->permissions);
	}
	
	public function findRoleById ( int $role_id ) {
		return Role::query()
				   ->findOrFail($role_id);
	}
	
	public function update ( Request $request , int $role_id ) {
		$role = $this->findRoleById($role_id);
		
		return $role->syncPermissions($request->permissions)
					->update([ 'name' => $request->name ]);
	}
	
	public function delete(int $role_id)
	{
		$role = $this->findRoleById($role_id);
		return $role->delete();
	}
}