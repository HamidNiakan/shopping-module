<?php

namespace Dev\User\Notifications;

use Carbon\Carbon;
use Dev\User\Mail\VerifyCodeMail;
use Dev\User\Services\VerifyCodeService;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class VerifyMailNotification extends Notification {
	use Queueable;
	
	/**
	 * Create a new notification instance.
	 *
	 * @return void
	 */
	public function __construct () {
		//
	}
	
	/**
	 * Get the notification's delivery channels.
	 *
	 * @param mixed $notifiable
	 * @return array
	 */
	public function via ( $notifiable ) {
		return [ 'mail' ];
	}
	
	/**
	 * Get the mail representation of the notification.
	 *
	 * @param mixed $notifiable
	 * @return \Illuminate\Notifications\Messages\MailMessage
	 */
	public function toMail ( $notifiable ) {
		
		$code = VerifyCodeService::generateCode();
		VerifyCodeService::store($notifiable->id , $code , Carbon::now()
																 ->addSeconds(120));
		
		return ( new VerifyCodeMail($notifiable , $code) );
	}
}
