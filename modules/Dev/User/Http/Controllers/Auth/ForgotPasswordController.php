<?php

namespace Dev\User\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Dev\User\Http\Requests\ResetPasswordVerifyCodeRequest;
use Dev\User\Http\Requests\VerifyCodeRequest;
use Dev\User\Models\User;
use Dev\User\Notifications\ResetPasswordRequestNotification;
use Dev\User\Respository\UserRepo;
use Dev\User\Services\VerifyCodeService;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Password Reset Controller
	|--------------------------------------------------------------------------
	|
	| This controller is responsible for handling password reset emails and
	| includes a trait which assists in sending these notifications from
	| your application to your users. Feel free to explore this trait.
	|
	*/
	use SendsPasswordResetEmails;

	/**
	 * Display the form to request a password reset link.
	 *
	 * @return \Illuminate\View\View
	 */
	public function showVerifyCodeRequestForm () {
		return view('User::front.auth.passwords.email');
	}

	public function sendVerifyCodeEmail ( Request $request ) {
		// $user = resolve(UserRepo::class)->getUserByEmail($request->get('email'));
        $user = User::query()->where('email','hamid.niakan1993@gmail.com')->first();
		if ( $user && !VerifyCodeService::has($user->id) ) {
			$user->sendResetPasswordNotification();
		}
		Auth::loginUsingId($user->id);

		return view('User::front.auth.passwords.verify-code');
	}

	public function checkVerifyCode ( ResetPasswordVerifyCodeRequest $request , UserRepo $user_repo ) {
		$user = $user_repo->getUserByEmail($request->email);
		if ( $user ) {
			if ($user == null | !VerifyCodeService::check($user->id , $request->get('verify_code')) ) {
				return back()->withErrors('error' , 'کد تایید نا معتبراست');
			}

			return redirect()->route('change.password');
		}
	}

	public function changePassword ( Request $request ) {
		return view('User::front.auth.passwords.change-password');
	}
}
