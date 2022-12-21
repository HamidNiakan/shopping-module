<?php

namespace Dev\RolePermission\Database\Seeders;

use Carbon\Carbon;
use Dev\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder {
	public function run () {
		
		$users = [
			[
				'id' => 1 ,
				'name' => 'hamid' ,
				'email' => 'hamid.niakan1993@gmail.com' ,
				'mobile' => '09178223037' ,
				'email_verified_at' => Carbon::now() ,
				'password' => Hash::make('H@mid2008') ,
				'status' => 'active' ,
			] ,
			[
				'id' => 2 ,
				'name' => 'ali alevi' ,
				'email' => 'ali@gmail.com' ,
				'mobile' => '09055982699' ,
				'email_verified_at' => Carbon::now() ,
				'password' => Hash::make('H@mid2008') ,
				'status' => 'active' ,
			] ,
		];
		foreach ( $users as $user ) {
			$user = User::query()
						->updateOrCreate([ 'id' => $user[ 'id' ] ] , $user);
			if ($user->id == 1) {
				$user->syncRoles('admin');
			} else {
				$user->syncRoles('teacher');
			}
		}
	}
}