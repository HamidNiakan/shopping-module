<?php

namespace Dev\Course\Providers;

use Dev\User\Models\User;
use Illuminate\Support\ServiceProvider;

class CourseServiceProvider extends ServiceProvider {
	public function register () {
		config()->set('auth.providers.users.model' , User::class);
		$this->loadRoutesFrom(__DIR__ . '/../Routes/web_route.php');
		$this->loadViewsFrom(__DIR__ . '/../Resources/Views' , 'Courses');
		$this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
		$this->loadTranslationsFrom(__DIR__.'/../Lang','LangCourses');
	}
	
	public function boot () {
		$this->app->booted(function () {
			config()->set('sideBar.items.courses' , [
				'icon' => 'i-courses' ,
				'title' => 'دوره ها' ,
				'route' => route('courses.index') ,
			]);
		});
	}
}