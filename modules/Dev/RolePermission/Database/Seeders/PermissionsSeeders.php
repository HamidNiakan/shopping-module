<?php

namespace Dev\RolePermission\Database\Seeders;

use Illuminate\Database\Seeder;
use Dev\RolePermission\Models\Permission;

class PermissionsSeeders extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run () {
		foreach ( Permission::$permissions as $key => $item ) {
			Permission::query()
					  ->updateOrCreate([
										   'id' => $key + 1 ,
									   ] , [
										   'name' => $item ,
									   ]);
		}
	}
}
