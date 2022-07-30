<?php

namespace Dev\Category\Providers;
use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class CategoryServiceProvider extends ServiceProvider {
	
	public function register () {
		config()->set('auth.providers.users.model',User::class);
	}
	
	public function boot() {
		$this->loadViewsFrom(__DIR__.'/../Resources/Views','Category');
		$this->loadRoutesFrom(__DIR__.'/../Routes/web_route.php');
		$this->loadMigrationsFrom(__DIR__.'/../Database/Migrations');
		
	}
}