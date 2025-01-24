<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrusteeBoardTable extends Migration
{
    public function up()
    {
        Schema::create('trustee_board', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('funder_id')->nullable(); // Funder ID (foreign key)
            $table->string('trustee', 255)->nullable(); // Trustee Name
            $table->string('position', 255)->nullable(); // Position
            $table->enum('status', ['Up-to-date', 'Recently', 'Registered'])->nullable(); // Status
            $table->timestamps(); // Created at and Updated at

            // Foreign key constraint
            $table->foreign('funder_id')
                  ->references('id')
                  ->on('funders')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('trustee_board', function (Blueprint $table) {
            $table->dropForeign(['funder_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('trustee_board');
    }
}