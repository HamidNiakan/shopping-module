<?php

namespace Dev\User\Mail;

use Dev\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable {
	use Queueable , SerializesModels;
	
	public User $user;
	public int  $code;
	
	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct ( User $user , int $code ) {
		$this->user = $user;
		$this->code = $code;
	}
	
	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build () {
		return $this->markdown('User::mails.reset-password')
					->to($this->user->email)
					->subject('بازیابی رمزعبور');
	}
}
