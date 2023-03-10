<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the Migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('username',50)->nullable();
            $table->string('mobile',14)->unique()->nullable();
            $table->string('headline')->nullable();
            $table->text('bio')->nullable();
            $table->text('website')->nullable();
            $table->text('instagram')->nullable();
            $table->text('telegram')->nullable();
            $table->text('youtube')->nullable();
            $table->text('facebook')->nullable();
            $table->text('twitter')->nullable();
            $table->text('linkedin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
			$table->enum('status',['active','inactive','ban'])->default('active');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the Migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
