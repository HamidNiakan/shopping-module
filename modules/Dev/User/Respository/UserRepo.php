<?php

namespace Dev\User\Respository;

use Dev\User\Models\User;

class UserRepo {
	public function getUserByEmail ( $email ) {
		return User::query()
				   ->whereEmail($email)
				   ->first();
	}
	
	public function findById ( int $user_id ) {
		return User::query()
				   ->find($user_id);
	}
	
	public function getTeachers () {
		return User::query()
				   ->teacher()
				   ->get();
	}
}
