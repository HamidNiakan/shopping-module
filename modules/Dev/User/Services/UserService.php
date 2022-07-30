<?php

namespace Dev\User\Services;
use Dev\User\Models\User;

class UserService {
	public static function updatePassword ( User $user , string $password ) {
		$user->password = bcrypt($password);
		$user->save();
		
		return $user;
	}
}