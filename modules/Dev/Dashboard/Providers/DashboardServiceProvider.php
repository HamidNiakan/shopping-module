<?php

namespace Dev\Dashboard\Providers;

use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider {
	public function register () {
		config()->set('auth.providers.users.model' , User::class);
	}
	
	public function boot () {
		$this->loadRoutesFrom(__DIR__ . '/../Routes/dashboard_route.php');
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Dashboard');
	}
}