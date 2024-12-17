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
        Schema::create('athlete_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->float('height')->nullable();
            $table->float('weight')->nullable();
            $table->enum('body_type', ['Ectomorph', 'Mesomorph', 'Endomorph'])->nullable();
            $table->string('profile_image')->nullable();
            $table->string('unique_string')->unique();
            $table->string('face_calc')->nullable();
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('athlete_profiles');
    }
};
