// database/migrations/2024_xx_xx_create_skills_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('skills', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('category'); // z.B. 'Frontend', 'Backend', 'Tools'
            $table->integer('level')->default(50); // 0-100%
            $table->string('icon')->nullable(); // Icon-Name oder Pfad
            $table->string('color')->nullable(); // Hex-Farbe
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('skills');
    }
};