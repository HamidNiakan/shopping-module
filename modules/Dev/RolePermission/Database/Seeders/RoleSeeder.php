<?php

namespace Dev\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run () {
		foreach ( \Dev\RolePermission\Models\Role::$roles as $name => $permission ) {
			Role::findByName($name)
				->givePermissionTo($permission);
		}
	}
}