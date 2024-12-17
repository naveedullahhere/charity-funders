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
        Schema::table('media', function (Blueprint $table) {
            // Add the event_id foreign key column
            $table->unsignedBigInteger('event_id')->nullable()->after('group_id'); // Assuming 'id' is the last column before event_id

            // Add foreign key constraint
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            // Drop the foreign key constraint
            $table->dropForeign(['event_id']);

            // Drop the event_id column
            $table->dropColumn('event_id');
        });
    }
};
