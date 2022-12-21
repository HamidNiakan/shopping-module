<?php
use Illuminate\Support\Facades\Route;
use Dev\RolePermission\Http\Controllers\RolePermissionController as rolePermission;

Route::controller(rolePermission::class)
	->middleware(['web','auth','verified'])
	->name('role-permission.')
	->prefix('rolePermission')
	->group(function () {
		Route::get('index','index')->name('index');
		Route::post('store','store')->name('store');
		Route::delete('destroy/{id}','destroy')->name('destroy');
		Route::get('edit/{role}','edit')->name('edit');
		Route::post('update/{id}','update')->name('update');
	});