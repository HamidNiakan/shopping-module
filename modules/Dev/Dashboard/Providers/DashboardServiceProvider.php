<?php

namespace Dev\Dashboard\Providers;

use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class DashboardServiceProvider extends ServiceProvider {
	public function register () {
		config()->set('auth.providers.users.model' , User::class);
		$this->loadRoutesFrom(__DIR__ . '/../Routes/dashboard_route.php');
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Dashboard');
		$this->mergeConfigFrom(__DIR__ . '/../Config/side-bar.php' , 'sideBar');
	}
	
	public function boot () {
		
		$this->app->booted(function () {
			config()->set('sideBar.items.dashboard' , [
				'icon' => 'i-dashboard' ,
				'title' => 'پیشخوان' ,
				'route' => route('dashboard.home') ,
			/* Closing the array. */
			]);
		});
	}
}
