<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
			$table->foreignId('teacher_id')->constrained('users')->cascadeOnDelete();
			$table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
			$table->foreignId('banner_id')->nullable();
			$table->string('title');
			$table->string('slug');
			$table->float('priority')->nullable();
			$table->integer('price');
			$table->string('teacher_percent',5);
			$table->enum('type',\Dev\Course\Models\Course::$types);
			$table->enum('status',\Dev\Course\Models\Course::$statuses);
			$table->enum('confirmation_status',\Dev\Course\Models\Course::$confirmationStatuses)->nullable();
			$table->longText('body')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('courses');
    }
};
