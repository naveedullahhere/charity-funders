<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->decimal('price_per_high_image', 10, 2)->nullable();
            $table->decimal('price_per_high_video', 10, 2)->nullable();
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropColumn('price_per_high_image');
            $table->dropColumn('price_per_high_video');
        });
    }
};
