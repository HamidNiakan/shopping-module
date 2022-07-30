<?php

namespace Dev\User\Respository;
use Dev\User\Models\User;

class UserRepo {
	public function getUserByEmail ( $email ) {
		return User::query()
				   ->whereEmail($email)
				   ->first();
	}
}
