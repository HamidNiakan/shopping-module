<?php

namespace Dev\User\Tests\Feature;

use Dev\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
	use WithFaker;
	use RefreshDatabase;
    /**
     * user can see login form
     *
     * @return void
     */
    public function test_user_can_see_login_form()
    {
        $response = $this->get(route('login'));

        $response->assertStatus(200);
    }
	
	public function test_user_can_login_email()
	{
		$this->withoutExceptionHandling();
			$response = $this->loginWithEmail();
			$this->assertAuthenticated();
			$response->assertRedirect(route('dashboard.home'));
	}
	
	public function test_user_can_login_mobile()
	{
		$response = $this->loginWithMobile();
		$this->assertAuthenticated();
		$response->assertRedirect(route('dashboard.home'));
	}
	
	protected function loginWithEmail() {
		$user = User::create([
			'name' => $this->faker->name,
			'email' => $this->faker->email,
			'password' => bcrypt('H@mid2008')
							 ]);
		return $this->post(route('login'),[
			'email' => $user->email,
			'password' => 'H@mid2008'
		]);
	}
	
	protected function loginWithMobile() {
		$user = User::create([
								 'name' => $this->faker->name,
								 'email' => $this->faker->email,
								 'mobile' => $this->faker->phoneNumber,
								 'password' => bcrypt('H@mid2008')
							 ]);
		return $this->post(route('login'),[
			'email' => $user->mobile,
			'password' => 'H@mid2008'
		]);
	}
}
