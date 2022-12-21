<?php

namespace Dev\Course\Rules;

use Dev\User\Respository\UserRepo;
use Illuminate\Contracts\Validation\Rule;

class ValidTeacher implements Rule {
	/**
	 * @inheritDoc
	 */
	public function passes ( $attribute , $value ) {
		$user = resolve(UserRepo::class)->findById($value);
		return $user->hasPermissionTo('tech');
	}
	
	/**
	 * @inheritDoc
	 */
	public function message () {
		return "کاربر انتخاب شده یک مدرس معتبر نیست.";
	}
}