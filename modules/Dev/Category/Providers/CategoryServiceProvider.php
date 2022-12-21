<?php

namespace Dev\Category\Providers;

use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider {
	public function register () {
		config()->set('auth.providers.users.model' , User::class);
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Category');
		$this->loadRoutesFrom(__DIR__ . '/../Routes/web_route.php');
		$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
	}
	
	public function boot () {
		
		$this->app->booted(function () {
			config()->set('sideBar.items.categories' , [
				'icon' => 'i-categories' ,
				'title' => 'دسته بندی' ,
				'route' => route('category.index') ,
			]);
		});
	}
}