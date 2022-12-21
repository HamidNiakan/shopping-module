<?php

namespace Dev\Category\Responses;

use Illuminate\Http\Response;

class AjaxResponses {
	public static function printResult ( string $message = null ) {
		return response()->json(compact('message') , Response::HTTP_OK);
	}
	
	public static  function  printError(string $message, int $status_code) {
		return response()->json(compact('message') , $status_code);
	}
}