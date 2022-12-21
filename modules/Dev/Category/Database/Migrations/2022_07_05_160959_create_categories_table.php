<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
	/**
	 * Run the Migrations.
	 *
	 * @return void
	 */
	public function up () {
		Schema::create('categories' , function ( Blueprint $table ) {
			$table->id();
			$table->string('name');
			$table->string('slug')
				  ->unique()
				  ->index();
			$table->foreignId('parent_id')
				  ->nullable()
				  ->constrained('categories');
			$table->timestamps();
		});
	}
	
	/**
	 * Reverse the Migrations.
	 *
	 * @return void
	 */
	public function down () {
		Schema::dropIfExists('categories');
	}
};
