<?php

namespace Dev\RolePermission\Models;

class Permission extends \Spatie\Permission\Models\Permission {
	const PERMISSION_MANAGE_CATEGORIES      = 'manage-categories';
	const PERMISSION_MANAGE_ROLE_PERMISSION = 'manage-role-permission';
	const PERMISSION_TEACH                  = 'tech';
	static $permissions = [
		self::PERMISSION_MANAGE_CATEGORIES,
		self::PERMISSION_MANAGE_ROLE_PERMISSION,
		self::PERMISSION_TEACH
	];
}