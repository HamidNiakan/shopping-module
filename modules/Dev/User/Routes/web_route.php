<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::namespace('Dev\User\Http\Controllers')
	->middleware('web')
	->group(function () {
	Auth::routes(['verify' => true]);
	Route::post('/email/verify','Auth\VerificationController@verify')->name('verification.verify');
	Route::post('/email/resend','Auth\VerificationController@resend')->name('verification.resend');
	Route::get('/email/verify','Auth\VerificationController@show')->name('verification.notice');

	// login
	Route::get('/login','Auth\LoginController@showLoginForm');
	Route::post('/login','Auth\LoginController@login')->name('login');

	//logout
	Route::post('/logout','Auth\LoginController@logout')->name('logout');

	//reset password
	Route::get('/password/reset','Auth\ForgotPasswordController@showVerifyCodeRequestForm')->name('password.request');
	Route::get('/password/reset/verify/code','Auth\ForgotPasswordController@sendVerifyCodeEmail')->name('password.verify.code.email');
	Route::post('/password/reset/check/verify/code','Auth\ForgotPasswordController@checkVerifyCode')->middleware('throttle:5,1')->name('password.verify.code');
	Route::get('/change/password','Auth\ForgotPasswordController@changePassword')->name('change.password');
	Route::get('/password/reset/form','Auth\ResetPasswordController@showResetForm')->name('password.reset.showResetForm');
	Route::post('/password/change','Auth\ResetPasswordController@reset')->name('password.change');


	//register
	Route::get('/register','Auth\RegisterController@showRegistrationForm')->name('register');
	Route::post('/register','Auth\RegisterController@register');

});
