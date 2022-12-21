<?php

namespace Dev\RolePermission\Providers;

use Closure;
use Database\Seeders\DatabaseSeeder;
use Dev\RolePermission\Database\Seeders\PermissionsSeeders;
use Dev\RolePermission\Database\Seeders\RoleSeeder;
use Dev\RolePermission\Database\Seeders\UserSeeder;
use Illuminate\Routing\Route;
use Illuminate\Support\ServiceProvider;

class RolePermissionServiceProvider extends ServiceProvider {
	public function register () {
		
		$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
		$this->loadRoutesFrom(__DIR__ . '/../Routes/web_route.php');
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'RolePermission');
		$this->loadJsonTranslationsFrom(__DIR__ . '/../Resources/Lang');
		DatabaseSeeder::$seeders[] = PermissionsSeeders::class;
		DatabaseSeeder::$seeders[] = RoleSeeder::class;
		DatabaseSeeder::$seeders[] = UserSeeder::class;
	}
	
	public function boot () {
		$this->app->booted(function () {
			config()->set('sideBar.items.role-permissions' , [
				'icon' => 'i-role-permissions' ,
				'title' => 'نقشه های کاربری' ,
				'route' => route('role-permission.index') ,
			]);
		});
	}
}