<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_courses', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('course_id');
            $table->boolean('is_favourite')->default(false);
            $table->boolean('is_in_progress')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->primary(['user_id','course_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_courses');
    }
};
