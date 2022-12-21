<?php

use Illuminate\Support\Facades\Route;

Route::controller(\Dev\Course\Http\Controllers\CourseController::class)
	 ->middleware(['web','auth'])
	->name('courses.')
	->prefix('course')
	->group(function () {
		Route::get('','index')->name('index');
		Route::get('create','create')->name('create');
		Route::post('store','store')->name('store');
		Route::get('edit/{course?}','edit')->name('edit');
		Route::patch('update/{id}','update')->name('update');
		Route::delete('destroy/{id}','destroy')->name('destroy');
		Route::patch('accept/{id}','accept')->name('accept');
		Route::patch('reject/{id}','reject')->name('reject');
		Route::patch('lock/{id}','lock')->name('lock');
	});