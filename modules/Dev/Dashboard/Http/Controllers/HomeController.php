<?php

namespace Dev\Dashboard\Http\Controllers;

use App\Http\Controllers\Controller;

class HomeController extends Controller {
	
	
	public function home () {
		return view('Dashboard::index');
	}
}
