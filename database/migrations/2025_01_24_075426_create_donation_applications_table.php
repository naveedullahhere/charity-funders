<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonationApplicationsTable extends Migration
{
    public function up()
    {
        Schema::create('donation_applications', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->unsignedBigInteger('funder_id')->nullable(); // Funder ID (foreign key)
            $table->integer('year')->nullable(); // Year
            $table->integer('received')->nullable(); // Received Applications
            $table->integer('successful')->nullable(); // Successful Applications
            $table->float('rate')->nullable(); // Success Rate
            $table->timestamps(); // Created at and Updated at

            // Foreign key constraint
            $table->foreign('funder_id')
                  ->references('id')
                  ->on('funders')
                  ->onDelete('cascade'); // Cascade on delete
        });
    }

    public function down()
    {
        Schema::table('donation_applications', function (Blueprint $table) {
            $table->dropForeign(['funder_id']); // Drop foreign key constraint
        });

        Schema::dropIfExists('donation_applications');
    }
}