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
        Schema::create('user_videos', function (Blueprint $table) {
            $table->integer('user_id');
            $table->integer('video_id');
            $table->boolean('is_favourite')->default(false);
            $table->boolean('is_in_progress')->default(false);
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->primary(['user_id','video_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_videos');
    }
};
