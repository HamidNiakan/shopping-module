<?php

namespace Dev\Category\Responses;

use Illuminate\Http\Response;

class AjaxResponses {
	public static function printResult ( string $message = null ) {
		return response()->json([
									'message' => $message,
								] , Response::HTTP_OK);
	}
}