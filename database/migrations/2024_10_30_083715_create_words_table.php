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
        Schema::create('words', function (Blueprint $table) {
            $table->id(); // id INT AUTO_INCREMENT PRIMARY KEY
            $table->string('word', ); // word VARCHAR(100) NOT NULL
            $table->string('meaning'); // meaning VARCHAR(255) NOT NULL
            $table->string('type', )->nullable(); // type VARCHAR(50), nullable
            $table->string('ipa', )->nullable(); // ipa VARCHAR(100), nullable
            $table->string('img_url')->nullable(); // img_url VARCHAR(255), nullable
            $table->timestamps(); // created_at and updated_at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('words');
    }
};
