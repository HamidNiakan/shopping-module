<?php

namespace Dev\User\Services;
use Carbon\Carbon;

class VerifyCodeService {
	private static $min    = 10000;
	private static $max    = 99999;
	private static $prefix = "verify-code-";
	
	public static function generateCode () {
		return random_int(self::$min , self::$max);
	}
	
	public static function store ( int $user_id , int $code, Carbon $carbon ) {
		cache()->set(self::$prefix . $user_id , $code , $carbon);
	}
	
	public static function get ( int $user_id ) {
		return cache()->get(self::$prefix . $user_id);
	}
	
	public static function has(int $user_id) {
		return cache()->has(self::$prefix.$user_id);
	}
	
	public static function destroy ( int $user_id ) {
		return cache()->delete(self::$prefix . $user_id);
	}
	
	public static function getRule () {
		
		return 'required|numeric|between:' . self::$min . ',' . self::$max;
	}
	
	public static function check ( $user_id , $code ) {
		if ( self::get($user_id) != $code ) return false;
		self::destroy($user_id);
		
		return true;
	}
}