<?php

namespace Dev\User\Http\Requests;

use Dev\User\Services\VerifyCodeService;
use Illuminate\Foundation\Http\FormRequest;

class VerifyCodeRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this
	 * request.
	 *
	 * @return bool
	 */
	public function authorize () {
		return true;
	}
	
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array<string, mixed>
	 */
	public function rules () {
		return [
			'verify_code' => VerifyCodeService::getRule() ,
		];
	}
	
	public function messages () {
		return [
			'verify_code.required' => 'کد فعال سازی را وارد کنید' ,
			'verify_code.numeric' => 'کد فعال سازی باید از نوع عدد باشد' ,
		];
	}
}
