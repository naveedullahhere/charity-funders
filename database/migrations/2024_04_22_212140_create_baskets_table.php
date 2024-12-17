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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->string('uniq_id')->unique(); // Make it unique
            $table->integer('status')->default(1); // 1: active, 0: completed
            $table->unsignedBigInteger('user_id'); // To track which user this basket belongs to
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade'); // Foreign key to users
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
