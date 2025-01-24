<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinancialsDetailsTable extends Migration
{
    public function up()
    {
        Schema::create('financials_details', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('funder_id')->nullable(); // Funder ID (foreign key)
            $table->string('year', 10)->nullable(); // Year
            $table->string('income', 30)->nullable(); // Income
            $table->string('spend', 30)->nullable(); // Spend
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
        Schema::table('financials_details', function (Blueprint $table) {
            $table->dropForeign(['funder_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('financials_details');
    }
}