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
        Schema::table('collection_media_mapping', function (Blueprint $table) {
            // Add the file_type column
            $table->enum('file_type', ['video', 'image'])->after('media_id')->nullable(); // Replace 'your_column_name' with the actual column name after which you want to add this field
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('collection_media_mapping', function (Blueprint $table) {
            // Drop the file_type column
            $table->dropColumn('file_type');
        });
    }
};
