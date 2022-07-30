<?php

namespace Dev\User\Tests\Feature;

use Dev\User\Models\User;
use Dev\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ResetPasswordTest extends TestCase {
	use WithFaker;
	use RefreshDatabase;

    private string $email = "hamid.niakan1993@gmail.com";

	public function test_can_user_ses_password_reset_form()
    {
       $this->get(route('password.request'))->assertOk();
    }

    public function test_user_send_email_correct()
    {
        $this->registerNewUser();
        $this->call('get',route('password.verify.code.email'),['email' => 'hamid.niakan1993@gmail.com'])
        ->assertOk();
    }

    public function test_user_ban_after_6_attempt_to_reser_password()
    {
        for ($i=1; $i < 6; $i++) {
            $this->post(route('password.verify.code'),['email' => 'hamid.niakan1993@gmail.com','verify_code'])->assertStatus(302);
        }
        $this->post(route('password.verify.code'),['email' => 'hamid.niakan1993@gmail.com','verify_code'])->assertStatus(429);
    }

    public function registerNewUser () {
		return $this->post(route('register') , [
			'name' => $this->faker->name ,
			'email' => 'hamid.niakan1993@gmail.com' ,
			'mobile' => '9178223037' ,
			'password' => 'H@mid2008' ,
			'password_confirmation' => 'H@mid2008' ,
		]);
	}


}
