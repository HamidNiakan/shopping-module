<?php

namespace Dev\Media\Providers;
use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider {
	
	public function register () {
		parent::register(); // TODO: Change the autogenerated stub
		config()->set('auth.providers.users.model' , User::class);
		$this->loadRoutesFrom(__DIR__ . '/../Routes/Media_route.php');
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Media');
		$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
	}
	
	public function boot() {
	}
}