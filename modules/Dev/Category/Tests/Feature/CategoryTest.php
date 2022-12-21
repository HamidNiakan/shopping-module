<?php

namespace Dev\Category\Tests\Feature;

use Carbon\Carbon;
use Dev\Category\Models\Category;
use Dev\RolePermission\Database\Seeders\PermissionsSeeders;
use Dev\RolePermission\Models\Permission;
use Dev\User\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CategoryTest extends TestCase {
	use WithFaker;
	use RefreshDatabase;
	
	public function test_manage_categories_permission_holders_can_see_categories_panel () {
		$this->actingAsAdmin();
		$this->seed(PermissionsSeeders::class);
		auth()->user()->givePermissionTo('manage-categories');
		$this->get(route('category.index'))
			 ->assertOk();
	}
	
	public function test_normal_user_can_not_see_categories_panel () {
		$this->actingAsAdmin();
		$this->get(route('category.index'))
			 ->assertStatus(200);
	}
	
	
	
	public function test_user_can_create_category () {
		$this->actingAsAdmin();
		$this->seed(PermissionsSeeders::class);
		auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
		$this->createCategory();
		$this->assertEquals(1 , Category::all()
										->count());
	}
	
	public function test_permitted_user_can_update_category () {
		$title = "sdasdsa";
		$this->actingAsAdmin();
		$this->seed(PermissionsSeeders::class);
		auth()->user()->givePermissionTo(Permission::PERMISSION_MANAGE_CATEGORIES);
		$this->createCategory();
		$this->assertEquals(1 , Category::all()
										->count());
		$this->post(route('category.update' , 1) , [
			'name' => $title ,
			'slug' => $this->faker->word ,
		]);
		$this->assertEquals(1 , Category::query()
										->whereName($title)
										->count());
	}
	
	public function test_user_can_delete_category () {
		$this->actingAsAdmin();
		$this->createCategory();
		$this->assertEquals(1 , Category::query()
										->count());
		$this->delete(route('category.destroy' , 1));
		$this->assertEquals(0 , Category::query()
										->count());
	}
	
	protected function actingAsAdmin () {
		$user = User::create([
								 'name' => $this->faker->name ,
								 'email' => $this->faker->email ,
								 'mobile' => '9178223037' ,
								 'password' => 'H@mid2008' ,
								 'password_confirmation' => 'H@mid2008' ,
								 'email_verified_at' => Carbon::now() ,
								 'status' => 'active' ,
							 ]);
		$this->actingAs($user);
	}
	
	protected function createCategory () {
		$this->post(route('category.store') , [
			'name' => $this->faker->name ,
			'slug' => $this->faker->slug ,
		]);
	}
}