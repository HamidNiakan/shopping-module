<?php

namespace Dev\User\Tests\Feature;

use Dev\User\Models\User;
use Dev\User\Services\VerifyCodeService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RegistrationTest extends TestCase {
	use WithFaker;
	use RefreshDatabase;
	
	/**
	 * A basic feature test example.
	 *
	 * @return void
	 */
	public function test_can_user_see_register_form () {
		$response = $this->get(route('register'));
		$response->assertStatus(200);
	}
	
	/**
	 * @return void
	 */
	public function test_user_can_register () {
		$response = $this->registerNewUser();
		$response->assertRedirect(route('dashboard.home'));
		$this->assertCount(1 , User::all());
	}
	
	public function test_user_have_to_verify_account () {
		$this->registerNewUser();
		$response = $this->get(route('dashboard.home'));
		$response->assertRedirect(route('verification.notice'));
	}
	
	public function test_verifed_user_can_see_home_page () {
		$this->registerNewUser();
		$this->assertAuthenticated();
		auth()
			->user()
			->markEmailAsVerified();
		
		$this->get(route('dashboard.home'))
			 ->assertOk();
	}
	
	public function test_user_can_verify_account () {
		$user = $this->createUser();
		$code = VerifyCodeService::generateCode();
		auth()->loginUsingId($user->id);
		$this->assertAuthenticated();
		$this->post(route('verification.verify') , [
			'verify_code' => $code,
		]);
		$this->assertEquals(true , $user->fresh()
										->markEmailAsVerified());
	}
	
	public function registerNewUser () {
		return $this->post(route('register') , [
			'name' => $this->faker->name ,
			'email' => $this->faker->email ,
			'mobile' => '9178223037' ,
			'password' => 'H@mid2008' ,
			'password_confirmation' => 'H@mid2008' ,
		]);
	}
	
	public function createUser() {
		return User::query()->create([
										 'name' => $this->faker->name ,
										 'email' => $this->faker->email ,
										 'mobile' => '9178223037' ,
										 'password' => 'H@mid2008' ,
										 'password_confirmation' => 'H@mid2008' ,
									 ]);
	}
}
