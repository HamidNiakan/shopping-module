<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	public static array $seeders = [];
	
	/**
	 * Seed the application's database.
	 *
	 * @return void
	 */
	public function run () {
		
		foreach ( self::$seeders as $seed ) {
			$this->call($seed);
		}
	}
}
