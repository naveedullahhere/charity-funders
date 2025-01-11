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
        Schema::table('products', function (Blueprint $table) {
            $table->json('prices')->after('price')->default(json_encode([]))->nullable();
            $table->decimal('additional_charge', 10, 2)->after('prices')->default(0.00);
            // $table->integer('max_days_without_additional_charge')->after('additional_charge')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('prices');
            $table->dropColumn('additional_charge');
            $table->dropColumn('max_days_without_additional_charge');
        });
    }
};
