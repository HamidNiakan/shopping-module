<?php

namespace Dev\RolePermission\Repository;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepo {
	public function all () {
		return Permission::all();
	}
}