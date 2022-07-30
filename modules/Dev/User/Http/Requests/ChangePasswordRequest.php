<?php

namespace Dev\User\Http\Requests;

use Dev\User\Rules\ValidPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ChangePasswordRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this
	 * request.
	 *
	 * @return bool
	 */
	public function authorize () {
		return Auth::check() == true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules () {
		return [
			'password' => ['required','confirmed', new ValidPassword()],
			'password_confirmation' => ['required'],
		];
	}
	
	public function messages () {
		return [
			'verify_code.required' => 'کد فعال سازی را وارد کنید' ,
			'verify_code.numeric' => 'کد فعال سازی باید از نوع عدد باشد' ,
		];
	}
}
