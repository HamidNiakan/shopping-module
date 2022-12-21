<?php

namespace Dev\User\Mail;

use Dev\User\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VerifyCodeMail extends Mailable
{
    use Queueable, SerializesModels;
	
	public $code;
	public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,int $code)
    {
		$this->code = $code;
		$this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('User::mails.verify-mail')
			->to($this->user->email)
			->subject('بازیابی رمز عبور');
    }
}
