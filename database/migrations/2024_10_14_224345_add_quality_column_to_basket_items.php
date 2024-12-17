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
        Schema::table('basket_items', function (Blueprint $table) {
            // Add the file_type column
            $table->string('quality')->after('quantity')->nullable(); // Replace 'your_column_name' with the actual column name after which you want to add this field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('basket_items', function (Blueprint $table) {
            // Drop the file_type column
            $table->dropColumn('quality');
        });
    }
};
