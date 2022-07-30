<?php

use Dev\Dashboard\Http\Controllers\HomeController as home;
use Illuminate\Support\Facades\Route;



Route::controller(home::class)->middleware(['web','auth','verified'])->group(function () {
	Route::get('home','home')->name('home');
});