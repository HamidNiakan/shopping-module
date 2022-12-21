<?php
use Illuminate\Support\Facades\Route;
use Dev\Category\Http\Controllers\CategoryController as category;
Route::controller(category::class)
	->middleware(['web','auth'])
	->name('category.')
	->group(function () {
	Route::get('category','index')->name('index');
	Route::post('category/store','store')->name('store');
	Route::get('category/edit/{id}','edit')->name('edit');
	Route::post('category/update/{id}','update')->name('update');
	Route::delete('category/destroy/{id}','destroy')->name('destroy');
});